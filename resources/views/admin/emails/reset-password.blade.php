<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Password Admin</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f6f9; padding: 20px;">
    <div style="max-width: 500px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 12px; text-align: center; border: 1px solid #e2e8f0;">
        <h2 style="color: #1e3a8a; margin-bottom: 10px;">Permintaan Reset Password Admin</h2>
        <p style="color: #64748b; font-size: 14px; line-height: 1.5;">
            Anda menerima email ini karena ada permintaan reset password untuk akun Admin RO3 Jasamarga.
        </p>
        <div style="margin: 30px 0;">
            <a href="{{ $resetLink }}" target="_blank" style="background-color: #1e3a8a; color: #ffffff; padding: 12px 28px; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-block; font-size: 14px;">
                Reset Password Saya
            </a>
        </div>
        <p style="color: #94a3b8; font-size: 12px;">Jika Anda tidak merasa melakukan permintaan ini, abaikan email ini.</p>
        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 20px 0;">
        <p style="color: #94a3b8; font-size: 11px; word-break: break-all;">
            Jika tombol tidak bisa diklik, salin tautan berikut ke browser:<br>
            <a href="{{ $resetLink }}" style="color: #1e3a8a;">{{ $resetLink }}</a>
        </p>
    </div>
</body>
</html>