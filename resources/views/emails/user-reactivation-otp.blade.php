<x-mail::message>
# User Reactivation Authorization

A request has been initiated to **reactivate** the following user account in **{{ config('app.name') }}**:

<x-mail::table>
| Attribute | Details |
| :--- | :--- |
| **User Name** | {{ $targetUser->name }} |
| **User Email** | {{ $targetUser->email }} |
| **Current Status** | Inactive |
@if ($requestedBy)
| **Requested By** | {{ $requestedBy->name }} ({{ $requestedBy->email }}) |
@endif
| **Requested At** | {{ now()->format('M d, Y - h:i A T') }} |
</x-mail::table>

Use the following One-Time Password (OTP) to authorize this account reactivation:

<x-mail::panel>
<div style="text-align: center; font-size: 32px; font-weight: bold; letter-spacing: 8px; color: #ea580c; padding: 8px 0; font-family: monospace;">
{{ $otp }}
</div>
</x-mail::panel>

> **Security Notice:**
> - This OTP code is valid for **{{ $expiresInMinutes }} minutes** only.
> - Without this OTP code, the user account **will not be reactivated under any circumstance**.
> - Never share this code with anyone. If you or an authorized administrator did not initiate this request, please review your system access logs immediately.

Thanks,<br>
**{{ config('app.name') }} Security System**
</x-mail::message>

