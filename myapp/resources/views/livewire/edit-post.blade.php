
<div class="max-w-2xl mx-auto p-6">
    <flux:heading size="xl" level="1" class="mb-5">記事編集ページ</flux:heading>

    <div x-data="{ title: @entangle('title'), body: @entangle('body') }"  class="space-y-2">
        <form wire:submit ="update" class="space-y-6">
            <flux:input x-model="title" wire:model="title" label="タイトル" placeholder="記事のタイトルを入力" />

            <flux:textarea x-model="body" wire:model="body" label="本文" rows="5" placeholder="本文を入力" />
            <p class="text-sm text-neutral-500">現在<span x-text="body.length"></span>文字</p>

            <div class="flex justify-end gap-2">
                <flux:button href="{{ route('my-posts') }}" wire:navigate>
                    キャンセル
                </flux:button>
                <flux:button type="submit" variant="primary">
                    更新する
                </flux:button>
            </div>
        </form>

        <section class="p-4 border border-neutral-200 dark:border-neutral-700 rounded-xl mt-10">
            <flux:heading size="lg" level="2">プレビュー</flux:heading>

            <article class="mt-4 space-y-3">
                <flux:heading size="xl" level="3"><span x-text="title || 'タイトル未入力'"></span></flux:heading>
                <flux:text class="whitespace-pre-line"><span x-text="body || '本文未入力'"></span></flux:text>
                <p class="text-sm text-neutral-500">現在<span x-text="body.length"></span>文字</p>
            </article>
        </section>
    </div>
</div>

