<div
    x-data="{ 'showModal': false }"
    @keydown.escape="showModal = false"
>
    <!-- Trigger for Modal -->
    <button type="button" @click="showModal = true">Open Modal</button>

    <!-- Modal -->
    <div
        class="fixed inset-0 z-30 flex items-baseline justify-center pt-10 overflow-auto bg-black bg-opacity-50"
        x-show="showModal"
    >
        <!-- Modal inner -->
        <div
            class="lg:w-1/2 md:11/12 mx-auto text-left bg-white rounded shadow-lg"
            @click.away="showModal = false"
            x-transition:enter="motion-safe:ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
        >
            <!-- Title / Close-->
            <div class="flex items-center justify-between px-6 py-4">
                <h3 class="mr-3 text-black text-2xl max-w-none">Title</h3>

                <button type="button" class="z-50 cursor-pointer" @click="showModal = false">
                    <x-heroicon-s-x-mark class="h-8"/>
                </button>
            </div>

            <!-- content -->
            <div class="divide-y divide-gray-400 px-6 py-4">

            </div>
        </div>
    </div>
</div>
