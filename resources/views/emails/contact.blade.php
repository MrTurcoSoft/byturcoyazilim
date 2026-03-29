<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #3B82F6; color: white; padding: 20px; text-align: center; }
        .content { background: #f9f9f9; padding: 20px; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #666; }
        .value { margin-top: 5px; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Yeni İletişim Mesajı</h1>
        </div>
        <div class="content">
            <div class="field">
                <div class="label">Ad Soyad:</div>
                <div class="value">{{ $contact->name }}</div>
            </div>
            <div class="field">
                <div class="label">E-posta:</div>
                <div class="value">{{ $contact->email }}</div>
            </div>
            @if($contact->phone)
            <div class="field">
                <div class="label">Telefon:</div>
                <div class="value">{{ $contact->phone }}</div>
            </div>
            @endif
            @if($contact->company)
            <div class="field">
                <div class="label">Firma:</div>
                <div class="value">{{ $contact->company }}</div>
            </div>
            @endif
            <div class="field">
                <div class="label">Konu:</div>
                <div class="value">{{ $contact->subject }}</div>
            </div>
            <div class="field">
                <div class="label">Mesaj:</div>
                <div class="value">{!! nl2br(e($contact->message)) !!}</div>
            </div>
            <div class="field">
                <div class="label">Tarih:</div>
                <div class="value">{{ $contact->created_at->format('d.m.Y H:i') }}</div>
            </div>
        </div>
        <div class="footer">
            Bu e-posta {{ config('app.name') }} web sitesi üzerinden gönderilmiştir.
        </div>
    </div>
</body>
</html>
