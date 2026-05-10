    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="flex flex-col justify-center items-center aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <flux:heading size="lg">合計記事数</flux:heading>
                <p class="text-[80px]">{{ $total_posts }}</p>
            </div>

            <div class="flex flex-col justify-center items-center aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <flux:heading size="lg">合計自分の記事数</flux:heading>
                <p class="text-[80px]">{{ $total_my_posts }}</p>
            </div>

            <div class="flex flex-col justify-center items-center aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <flux:heading size="lg">合計ユーザー数</flux:heading>
                <p class="text-[80px]">{{ $total_users }}</p>
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <section class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
                <flux:heading size="lg" level="2">全体の最新記事</flux:heading>

                <div class="mt-4 space-y-3">
                    @foreach ($latest_posts as $post)
                        <a href="/posts/{{ $post->id }}" class="block">
                            <flux:text>{{ $post->created_at->format('Y/m/d') }}</flux:text>
                            <flux:heading size="md" level="3">
                                {{ $post->title }}
                            </flux:heading>
                            <flux:text>{{ $post->user->name }}</flux:text>
                        </a>
                    @endforeach
                </div>
            </section>

            <section class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
                <flux:heading size="lg" level="2">自分の最新記事</flux:heading>

                <div class="mt-4 space-y-3">
                    @foreach ($latest_my_posts as $post)
                        <a href="/posts/{{ $post->id }}/edit" class="block">
                            <flux:text>{{ $post->created_at->format('y/m/d') }}</flux:text>
                            <flux:heading size="md" level="3">
                                {{ $post->title }}
                            </flux:heading>
                        </a>
                    @endforeach
                </div>
            </section>
        </div>

        <div class="p-6 flex flex-col gap-3 relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <flux:text size="xl" class="flex items-center gap-1">
                <flux:icon.building-library class="size-5" />
                <flux:link href="{{ route('posts') }}">全記事一覧</flux:link>
            </flux:text>

            <flux:text size="xl" class="flex items-center gap-1">
                <flux:icon.book-open class="size-5" />
                <flux:link href="{{ route('my-posts') }}">自分の記事一覧</flux:link>
            </flux:text>

            <flux:text size="xl" class="flex items-center gap-1">
                <flux:icon.pencil class="size-5" />
                <flux:link href="{{ route('posts.create') }}">記事を書く</flux:link>
            </flux:text>
        </div>
    </div>


