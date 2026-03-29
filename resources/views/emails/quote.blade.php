<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #10B981; color: white; padding: 20px; text-align: center; }
        .content { background: #f9f9f9; padding: 20px; }
        .section { margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #ddd; }
        .section:last-child { border-bottom: none; }
        .section-title { font-size: 16px; font-weight: bold; color: #10B981; margin-bottom: 10px; }
        .field { margin-bottom: 10px; }
        .label { font-weight: bold; color: #666; }
        .value { margin-top: 3px; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Yeni Teklif Talebi</h1>
        </div>
        <div class="content">
            <div class="section">
                <div class="section-title">Müşteri Bilgileri</div>
                <div class="field">
                    <div class="label">Ad Soyad:</div>
                    <div class="value">{{ $quote->name }}</div>
                </div>
                <div class="field">
                    <div class="label">E-posta:</div>
                    <div class="value">{{ $quote->email }}</div>
                </div>
                @if($quote->phone)
                <div class="field">
                    <div class="label">Telefon:</div>
                    <div class="value">{{ $quote->phone }}</div>
                </div>
                @endif
                @if($quote->company)
                <div class="field">
                    <div class="label">Firma:</div>
                    <div class="value">{{ $quote->company }}</div>
                </div>
                @endif
            </div>
            
            <div class="section">
                <div class="section-title">Proje Detayları</div>
                <div class="field">
                    <div class="label">Proje Türü:</div>
                    <div class="value">{{ $quote->project_type }}</div>
                </div>
                <div class="field">
                    <div class="label">Açıklama:</div>
                    <div class="value">{!! nl2br(e($quote->project_description)) !!}</div>
                </div>
                @if($quote->budget_range)
                <div class="field">
                    <div class="label">Bütçe Aralığı:</div>
                    <div class="value">{{ $quote->budget_range }}</div>
                </div>
                @endif
                @if($quote->timeline)
                <div class="field">
                    <div class="label">Süre:</div>
                    <div class="value">{{ $quote->timeline }}</div>
                </div>
                @endif
            </div>
            
            @if($quote->preferred_date)
            <div class="section">
                <div class="section-title">Toplantı Tercihi</div>
                <div class="field">
                    <div class="label">Tercih Edilen Tarih:</div>
                    <div class="value">{{ $quote->preferred_date->format('d.m.Y') }} {{ $quote->preferred_time }}</div>
                </div>
            </div>
            @endif
            
            <div class="field">
                <div class="label">Talep Tarihi:</div>
                <div class="value">{{ $quote->created_at->format('d.m.Y H:i') }}</div>
            </div>
        </div>
        <div class="footer">
            Bu e-posta {{ config('app.name') }} web sitesi üzerinden gönderilmiştir.
        </div>
    </div>
</body>
</html>
