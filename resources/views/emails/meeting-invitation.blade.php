<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background: #f5f5f5; }
        .container { max-width: 600px; margin: 20px auto; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #4285f4 0%, #34a853 100%); color: white; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { padding: 30px; }
        .meeting-card { background: #f8f9fa; border-radius: 8px; padding: 20px; margin: 20px 0; border-left: 4px solid #4285f4; }
        .meeting-card h3 { margin: 0 0 15px 0; color: #4285f4; }
        .meeting-detail { display: flex; margin-bottom: 10px; }
        .meeting-detail .icon { width: 24px; margin-right: 10px; color: #666; }
        .meeting-detail .text { flex: 1; }
        .meet-button { display: inline-block; background: #00897b; color: white !important; text-decoration: none; padding: 15px 30px; border-radius: 8px; font-weight: bold; margin: 20px 0; text-align: center; }
        .meet-button:hover { background: #00796b; }
        .meet-link { background: #e8f5e9; padding: 15px; border-radius: 8px; word-break: break-all; margin: 15px 0; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; border-top: 1px solid #eee; }
        .calendar-icon { font-size: 48px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="calendar-icon">📅</div>
            <h1>Toplantı Davetiyesi</h1>
        </div>
        <div class="content">
            <p>Merhaba <strong>{{ $quote->name }}</strong>,</p>
            
            <p>Proje talebiniz için bir toplantı planlandı. Aşağıda toplantı detaylarını bulabilirsiniz:</p>
            
            <div class="meeting-card">
                <h3>{{ $quote->project_type }} - Proje Görüşmesi</h3>
                
                <div class="meeting-detail">
                    <div class="icon">📆</div>
                    <div class="text">
                        <strong>Tarih:</strong> {{ $startTime->locale('tr')->isoFormat('D MMMM YYYY, dddd') }}
                    </div>
                </div>
                
                <div class="meeting-detail">
                    <div class="icon">🕐</div>
                    <div class="text">
                        <strong>Saat:</strong> {{ $startTime->format('H:i') }} - {{ $endTime->format('H:i') }}
                    </div>
                </div>
                
                <div class="meeting-detail">
                    <div class="icon">⏱️</div>
                    <div class="text">
                        <strong>Süre:</strong> 1 saat
                    </div>
                </div>
            </div>
            
            @if($quote->meet_link)
            <h3 style="color: #00897b;">🎥 Google Meet ile Katılın</h3>
            <p>Toplantıya aşağıdaki bağlantıya tıklayarak katılabilirsiniz:</p>
            
            <div style="text-align: center;">
                <a href="{{ $quote->meet_link }}" class="meet-button">
                    🎥 Toplantıya Katıl
                </a>
            </div>
            
            <div class="meet-link">
                <strong>Meet Linki:</strong><br>
                <a href="{{ $quote->meet_link }}">{{ $quote->meet_link }}</a>
            </div>
            
            <p style="color: #666; font-size: 14px;">
                💡 <strong>İpucu:</strong> Toplantıya birkaç dakika erken katılmanızı öneririz. 
                Google Meet'i tarayıcınızdan veya mobil uygulamadan kullanabilirsiniz.
            </p>
            @endif
            
            <h3>Toplantı Öncesi Hazırlık</h3>
            <ul>
                <li>Proje ile ilgili sorularınızı hazırlayın</li>
                <li>Varsa referans örneklerinizi paylaşmaya hazır olun</li>
                <li>İnternet bağlantınızın stabil olduğundan emin olun</li>
            </ul>
            
            <p>Herhangi bir sorunuz varsa bu e-postaya yanıt vererek bize ulaşabilirsiniz.</p>
            
            <p>Görüşmek üzere!</p>
        </div>
        <div class="footer">
            <p>Bu e-posta {{ config('app.name') }} tarafından gönderilmiştir.</p>
            <p>{{ \App\Models\Setting::get('contact_email') }} | {{ \App\Models\Setting::get('contact_phone') }}</p>
        </div>
    </div>
</body>
</html>
