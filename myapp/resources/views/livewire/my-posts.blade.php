<div x-data="{
            confirmOpen:false,
            deleteId:null,
            deleteTitle: '',
            openDeleteModal(id, title) {
                this.deleteId = id;
                this.deleteTitle = title;
                this.confirmOpen = true;
            },
            closeDeleteModal() {
                this.confirmOpen = false;
                this.deleteId = null;
                this.deleteTitle = '';
            }
        }"
        class="max-w-4xl mx-auto p-6 space-y-6">
    <flux:heading size="xl" level="1" class="mb-5">自分の記事投稿一覧</flux:heading>

    <div class="flex justify-between items-center mb-6 gap-4 mt-6">
        <flux:input wire:model.live="search" icon="magnifying-glass" class="w-64" placeholder="タイトルで検索" />

        @if($search)
            <flux:button type="button" wire:click="clearSearch" icon="x-mark">クリア</flux:button>
        @endif

        @auth
            <flux:button href="{{ route('posts.create') }}" wire:navigate variant="primary">
                新規作成
            </flux:button>
        @endauth
    </div>

    @if (session('status'))
        <div wire:key="flash-message-{{ $flashKey }}"
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transition:leave="transition-opacity ease-in duration-700"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="p-4 bg-green-100 text-green-700 rounded">
            {{ session('status') }}
        </div>
    @endif

    @foreach ($posts as $post)
        <article class="p-4 shadow-lg">
            <flux:text class="mt-4 mb-2">{{ $post->created_at->format('y/m/d')}}</flux:text>
            <flux:badge>{{ $post->category }}</flux:badge>
            <flux:heading size="lg" level="2">{{ $post->title }}</flux:heading>
            <div class="flex items-center gap-2 shrink-0 mt-2">
                <flux:button
                    href="{{ route('posts.edit', $post->id) }}"
                    wire:navigate
                    icon="pencil-square"
                    size="sm"
                >編集</flux:button>

                <flux:button
                    type="button"
                    x-on:click="openDeleteModal({{ $post->id }}, {{ Js::from($post->title) }})"
                    variant="danger"
                    icon="trash"
                    size="sm"
                >削除</flux:button>
            </div>
        </article>
    @endforeach

    <div x-show="confirmOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
        <div class="w-full max-w-md rounded-xl bg-white p-6 shadow-xl dark:bg-neutral-900">
            <flux:heading size="lg" level="2">記事を削除しますか？</flux:heading>
            <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-300">「<span x-text="deleteTitle"></span>」を削除します。</p>

            <div class="mt-6 flex justify-end gap-2">
                <flux:button type="button" x-on:click="closeDeleteModal()">キャンセル</flux:button>
                <flux:button type="button" x-on:click="$wire.delete(deleteId); closeDeleteModal();" variant="danger">削除する</flux:button>
            </div>
        </div>
    </div>

    {{ $posts->links() }}
</div>
