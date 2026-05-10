
<div class="max-w-2xl mx-auto p-6">
    <flux:heading size="xl" level="1" class="mb-5">記事作成ページ</flux:heading>

    @if (session('status'))
        <div wire:key="flash-message-{{ $flashKey }}"
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transition:leave="transition-opacity ease-in duration-700"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('status') }}
        </div>
    @endif

    <div x-data="{ title: @entangle('title'), body: @entangle('body'), category: @entangle('category') }"  class="space-y-2">
        <form wire:submit ="save" class="space-y-6">
            <flux:input x-model="title" wire:model="title" label="タイトル" placeholder="記事のタイトルを入力" />

            <flux:select wire:model="category" label="カテゴリ">
                <option value="未分類">未分類</option>
                <option value="日記">日記</option>
                <option value="技術">技術</option>
                <option value="メモ">メモ</option>
            </flux:select>

            <flux:textarea x-model="body" wire:model="body" label="本文" rows="8" placeholder="本文を入力" />
            <p class="text-sm text-neutral-500">現在<span x-text="body.length"></span>文字</p>

            <div class="flex justify-end">
                <flux:button type="submit" variant="primary">
                    投稿する
                </flux:button>
            </div>
        </form>

        <section class="p-4 border border-neutral-200 dark:border-neutral-700 rounded-xl mt-10">
            <flux:heading size="lg" level="2">プレビュー</flux:heading>

            <article class="mt-4 space-y-3">
                <flux:heading size="xl" level="3"><span x-text="title || 'タイトル未入力'"></span></flux:heading>
                <flux:badge><span x-text="category || '未分類'"></span></flux:badge>
                <flux:text class="whitespace-pre-line"><span x-text="body || '本文未入力'"></span></flux:text>
                <p class="text-sm text-neutral-500">現在<span x-text="body.length"></span>文字</p>
            </article>
        </section>
    </div>
</div>

