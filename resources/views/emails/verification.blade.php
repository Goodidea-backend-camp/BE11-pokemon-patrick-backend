@component('mail::message')

    # 驗證您的電子郵件地址

    感謝您的註冊！請點擊下方的按鈕以驗證您的電子郵件地址。

    [驗證電子郵件地址]({{ $verificationUrl }})

    如果您未創建帳戶，則無需進一步操作。

    謝謝，
    {{ config('app.name') }}

@endcomponent
