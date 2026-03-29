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

## What's Been Implemented (29 Mart 2026)

### Frontend Pages
- ✅ Anasayfa (Hero, Services, Stats, References, Blog, CTA)
- ✅ Hakkımızda
- ✅ Hizmetler + Detay sayfaları
- ✅ Referanslar + Detay sayfaları
- ✅ Blog + Yazı detay sayfaları
- ✅ İletişim (form dahil)
- ✅ Teklif Al (randevu planlama dahil)

### Admin Panel
- ✅ Login sayfası
- ✅ Dashboard (istatistikler)
- ✅ Hizmetler CRUD
- ✅ Referanslar CRUD
- ✅ Blog CRUD
- ✅ Mesajlar yönetimi
- ✅ Teklif talepleri yönetimi
- ✅ Site ayarları (tema, iletişim, sosyal medya)

### Features
- ✅ Çoklu dil desteği (TR/EN)
- ✅ Tema değiştirme (koyu/açık)
- ✅ Responsive tasarım
- ✅ Modern UI (Outfit + Inter fontları)
- ✅ Data test ID'ler

## Database Models
- User (admin)
- Setting (site ayarları)
- Service (hizmetler)
- Reference (referanslar/portföy)
- BlogPost (blog yazıları)
- Contact (iletişim mesajları)
- Quote (teklif talepleri)

## Backlog / Future Features

### P0 (Critical)
- Tümü tamamlandı

### P1 (High Priority)
- [ ] Görsel yükleme sistemi (şu an URL ile)
- [ ] E-posta bildirimleri (yeni mesaj/teklif)
- [ ] Şifre sıfırlama

### P2 (Medium Priority)
- [ ] Blog yorum sistemi
- [ ] SEO meta tag yönetimi
- [ ] Sitemap oluşturucu
- [ ] Google Analytics entegrasyonu

### P3 (Nice to Have)
- [ ] Canlı chat widget
- [ ] Newsletter sistemi
- [ ] Çoklu admin desteği
- [ ] İstatistik grafikleri
