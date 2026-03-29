@extends('layouts.admin')

@section('header', 'Blog Yazıları')

@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500">Toplam {{ $posts->count() }} yazı</p>
    <a href="{{ route('admin.blog.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors" data-testid="add-blog-btn">
        + Yeni Yazı
    </a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Başlık</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tarih</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($posts as $post)
            <tr>
                <td class="px-6 py-4">
                    <div class="font-medium">{{ $post->title['tr'] ?? '-' }}</div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $post->category ?? '-' }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded-full {{ $post->is_published ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                        {{ $post->is_published ? 'Yayında' : 'Taslak' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $post->created_at->format('d.m.Y') }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('admin.blog.edit', $post) }}" class="text-blue-600 hover:underline">Düzenle</a>
                    <form action="{{ route('admin.blog.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Sil</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-gray-500">Henüz blog yazısı eklenmemiş</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
