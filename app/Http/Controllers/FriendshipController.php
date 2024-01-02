<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcceptFriendRequest;
use App\Http\Requests\RejectFriendRequest;
use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FriendshipController extends Controller
{
    public function sendFriendRequest(User $recipient)
    {
        // 取用登入者object
        $sender = auth()->user();

        // 檢查是否已經是好友
        if ($sender->isFriendWith($recipient) == true) {
            return response()->json(
                ['error' =>
                config('http_error_message.friendship.already_friends')],
                Response::HTTP_BAD_REQUEST
            );
        }

        // 檢查是否是自己
        if ($sender->id === $recipient->id) {
            return response()->json(
                ['error' =>
                config('http_error_message.friendship.cannot_send_request_to_yourself')],
                Response::HTTP_BAD_REQUEST
            );
        }

        // 創建好友邀請
        Friendship::create([
            'user_id' => $sender->id,
            'friend_id' => $recipient->id,
            'status' => 'pending',
        ]);


        return response()->json(
            ['success' =>
            config('http_success_message.friendship.invite_sent_successfully')],
            Response::HTTP_OK
        );
    }

    public function acceptFriendRequest(AcceptFriendRequest $request)
    {
        $request->validated();

        $friendship = Friendship::find($request->input('friendship_id'));

        // 檢查是否已經處於被接受的狀態
        if ($friendship->status === 'accepted') {
            return response()->json(
                ['error' =>
                config('http_error_message.friendship.already_accepted')],
                Response::HTTP_BAD_REQUEST
            );
        }

        // 更新好友邀請的狀態
        $friendship->update(['status' => 'accepted']);

        return response()->json(
            ['success' =>
            config('http_success_message.friendship.invitation_accepted')],
            Response::HTTP_OK
        );
    }

    public function rejectFriendRequest(RejectFriendRequest $request)
    {
        $request->validated();

        $friendship = Friendship::find($request->input('friendship_id'));
        // 檢查是否已經處於被接受或被拒絕的狀態
        if ($friendship->status === 'accepted' || $friendship->status === 'rejected') {
            return response()->json(
                ['error' =>
                config('http_error_message.friendship.already_processed')],
                Response::HTTP_BAD_REQUEST
            );
        }

        // 更新好友邀請的狀態為 'rejected'
        $friendship->update(['status' => 'rejected']);

        return response()->json(
            ['success' =>
            config('http_success_message.friendship.invitation_rejected')],
            Response::HTTP_OK
        );
    }

    public function removeFriend(User $friend)
    {
        // 獲取當前登入使用者
        $user = auth()->user();
        // 查找符合條件的 friendship
        $friendship = $user->friends()
            ->where('friendships.user_id', $user->id)
            ->where('friendships.friend_id', $friend->id)
            ->where('friendships.status', 'accepted')
            ->first();

        // 如果找到符合條件的 friendship，則刪除
        if ($friendship) {
            $user->friends()->detach($friendship->id);
            return response()->json(
                ['success' =>
                config('http_success_message.friendship.removed_successfully')],
                Response::HTTP_OK
            );
        } else {
            return response()->json(
                ['error' =>
                config('http_error_message.friendship.friend_not_found/not_accepted')],
                Response::HTTP_NOT_FOUND
            );
        }
    }

    public function getFriends()
    {
        // 獲取當前已認證的用戶
        $user = auth()->user();

        // 通過關聯獲取用戶的朋友清單（已按照順序排序）
        $friends = $user->friends()->orderBy('name')->get();

        $friendshipsData = [];

        foreach ($friends as $friend) {
            $friendship = Friendship::where('friend_id', $friend->id)->first();
            // 將資訊添加到陣列中
            $friendshipsData[] = [
                'friend_id' => $friend->id,
                'friend_name' => $friend->name,
                'status' => $friendship->status,
            ];
        }
        // 返回 JSON 格式的朋友清單
        return response()->json(['friends' => $friendshipsData], Response::HTTP_OK);
    }
}
