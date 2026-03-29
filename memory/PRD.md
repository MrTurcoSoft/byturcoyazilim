# Laravel Web Ajans - PRD

## Problem Statement
Laravel altyapısı kullanarak modern bir web sitesi ve yönetim paneli. Web tasarım/yazılım ajansı sitesi (webimedya.com ve trios.com.tr referansları ile).

## User Personas
1. **Site Ziyaretçisi**: Hizmetleri inceler, referansları görüntüler, teklif alır
2. **Admin/Yönetici**: Panelden tüm içerikleri yönetir

## Core Requirements
- Sayfalar: Anasayfa, Hakkımızda, Hizmetler, Referanslar, İletişim, Blog, Teklif Al
- Yönetim Paneli: Dashboard, CRUD işlemleri, Ayarlar
- Teklif oluşturma ve alma sistemi
- Çoklu dil desteği (TR/EN)
- Panelden tema değiştirme (koyu/açık)
- Tüm firma bilgileri panelden yönetilebilir

## Tech Stack
- Laravel 12
- PHP 8.2
- Tailwind CSS 4
- Vite
- SQLite
- Google Calendar API

## What's Been Implemented

### Phase 1 (29 Mart 2026) - MVP
- ✅ Anasayfa (Hero, Services, Stats, References, Blog, CTA)
- ✅ Hakkımızda, Hizmetler, Referanslar, Blog, İletişim, Teklif Al
- ✅ Admin Panel (Dashboard, CRUD, Ayarlar)
- ✅ Çoklu dil (TR/EN), Tema değiştirme

### Phase 2 (29 Mart 2026) - Yeni Özellikler
- ✅ SMTP E-posta Sistemi (Hostinger)
  - Yeni iletişim mesajı bildirimi
  - Yeni teklif talebi bildirimi
- ✅ SEO Meta Tag Yönetimi
  - Her sayfa için ayrı meta title, description, keywords
  - Open Graph ve Twitter Card desteği
  - Admin panelden yönetilebilir
- ✅ Google Calendar Entegrasyonu
  - OAuth2 ile bağlantı
  - Teklif taleplerini takvime ekleme
  - Takvimden kaldırma
- ✅ Görsel Yükleme Sistemi
  - Drag & drop yükleme
  - URL kopyalama
  - 5MB limit, resim formatları

## Database Models
- User (admin)
- Setting (site ayarları)
- Service (hizmetler)
- Reference (referanslar/portföy)
- BlogPost (blog yazıları)
- Contact (iletişim mesajları)
- Quote (teklif talepleri + calendar_event_id)
- SeoSetting (SEO ayarları)
- GoogleToken (OAuth tokens)

## Environment Variables
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_USERNAME=noreply@nielsenchase.co.uk
MAIL_ENCRYPTION=ssl
ADMIN_EMAIL=noreply@nielsenchase.co.uk

GOOGLE_CLIENT_ID=887819604443-...
GOOGLE_CLIENT_SECRET=GOCSPX-...
GOOGLE_REDIRECT_URI=.../api/oauth/calendar/callback
```

## Backlog / Future Features

### P1 (High Priority)
- [ ] Şifre sıfırlama
- [ ] Çoklu admin desteği

### P2 (Medium Priority)
- [ ] Blog yorum sistemi
- [ ] Sitemap oluşturucu
- [ ] Google Analytics entegrasyonu

### P3 (Nice to Have)
- [ ] Canlı chat widget
- [ ] Newsletter sistemi
- [ ] İstatistik grafikleri
