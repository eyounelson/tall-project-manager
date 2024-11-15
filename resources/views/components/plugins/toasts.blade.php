<div x-data>
    <!-- Trigger Button -->

    <!-- Notifications -->
    <div x-data="{
            notifications: [],
            displayDuration: 8000,

            addNotification({ variant = 'info', title = null, message = null}) {
                const id = Date.now()
                const notification = { id, variant, title, message }

                // Keep only the most recent 10 notifications
                if (this.notifications.length >= 10) {
                    this.notifications.splice(0, this.notifications.length - 9)
                }

                // Add the new notification to the notifications stack
                this.notifications.push(notification)

            },
            removeNotification(id) {
                setTimeout(() => {
                    this.notifications = this.notifications.filter(
                        (notification) => notification.id !== id,
                    )
                }, 400);
            },
        }" x-on:notify.window="addNotification({
                variant: $event.detail.variant,
                title: $event.detail.title,
                message: $event.detail.message,
    })">
        <div x-on:mouseenter="$dispatch('pause-auto-dismiss')"
             x-on:mouseleave="$dispatch('resume-auto-dismiss')"
             class="group pointer-events-none fixed top-0 right-0 z-[99] flex max-w-full flex-col gap-2 bg-transparent px-6 py-6 md:max-w-sm">
            <template x-for="(notification, index) in notifications"
                      x-bind:key="notification.id">
                <!-- root div holds all of the notifications  -->
                <div>
                    <!-- Info Notification  -->
                    <template x-if="notification.variant === 'info'">
                        <div x-data="{ isVisible: false, timeout: null }"
                             x-cloak
                             x-show="isVisible"
                             class="pointer-events-auto relative rounded-md border border-grey-500 bg-white text-neutral-600"
                             x-on:pause-auto-dismiss.window="clearTimeout(timeout)"
                             x-on:resume-auto-dismiss.window=" timeout = setTimeout(() => {(isVisible = false), removeNotification(notification.id) }, displayDuration)"
                             x-init="$nextTick(() => { isVisible = true }), (timeout = setTimeout(() => { isVisible = false, removeNotification(notification.id)}, displayDuration))"
                             x-transition:enter="transition duration-300 ease-out"
                             x-transition:enter-end="translate-y-0"
                             x-transition:enter-start="translate-y-8"
                             x-transition:leave="transition duration-300 ease-in"
                             x-transition:leave-end="-translate-x-24 opacity-0 md:translate-x-24"
                             x-transition:leave-start="translate-x-0 opacity-100"
                             role="status"
                             aria-live="polite"
                             aria-atomic="true" >
                            <div class="flex w-full items-center gap-2.5 bg-grey-500/10 rounded-md p-4 transition-all duration-300">

                                <!-- Icon -->
                                <div class="rounded-full bg-grey-500/15 p-0.5 text-grey-500" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z" clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <!-- Title & Message -->
                                <div class="flex flex-col gap-2">
                                    <h3
                                        role="alert"
                                        aria-live="assertive"
                                        x-cloak
                                        x-show="notification.title"
                                        class="text-sm font-semibold text-grey-500"
                                        x-text="notification.title"></h3>

                                    <p
                                        role="alert"
                                        aria-live="assertive"
                                        x-cloak
                                       x-show="notification.message"
                                       class="text-pretty text-sm"
                                       x-text="notification.message"></p>
                                </div>

                                <!--Dismiss Button -->
                                <button type="button"
                                        class="ml-auto"
                                        aria-label="dismiss notification"
                                        x-on:click="(isVisible = false), removeNotification(notification.id)">
                                    <x-heroicon-s-x-mark class="h-8"/>
                                </button>
                            </div>
                        </div>
                    </template>

                    <!-- Success Notification  -->
                    <template x-if="notification.variant === 'success'">
                        <div x-data="{ isVisible: false, timeout: null }" x-cloak x-show="isVisible" class="pointer-events-auto relative rounded-md border border-green-500 bg-white text-neutral-600 " role="alert" x-on:pause-auto-dismiss.window="clearTimeout(timeout)" x-on:resume-auto-dismiss.window=" timeout = setTimeout(() => {(isVisible = false), removeNotification(notification.id) }, displayDuration)" x-init="$nextTick(() => { isVisible = true }), (timeout = setTimeout(() => { isVisible = false, removeNotification(notification.id)}, displayDuration))" x-transition:enter="transition duration-300 ease-out" x-transition:enter-end="translate-y-0" x-transition:enter-start="translate-y-8" x-transition:leave="transition duration-300 ease-in" x-transition:leave-end="-translate-x-24 opacity-0 md:translate-x-24" x-transition:leave-start="translate-x-0 opacity-100">
                            <div class="flex w-full items-center gap-2.5 bg-green-500/10 rounded-md p-4 transition-all duration-300">

                                <!-- Icon -->
                                <div class="rounded-full bg-green-500/15 p-0.5 text-green-500" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <!-- Title & Message -->
                                <div class="flex flex-col gap-2">
                                    <h3 role="alert" aria-live="assertive" x-cloak x-show="notification.title" class="text-sm font-semibold text-green-500" x-text="notification.title"></h3>
                                    <p  role="alert" aria-live="assertive" x-cloak x-show="notification.message" class="text-pretty text-sm" x-text="notification.message"></p>
                                </div>

                                <!--Dismiss Button -->
                                <button type="button" class="ml-auto" aria-label="dismiss notification" x-on:click="(isVisible = false), removeNotification(notification.id)">
                                    <x-heroicon-s-x-mark class="h-8"/>
                                </button>
                            </div>
                        </div>
                    </template>

                    <!-- Warning Notification  -->
                    <template x-if="notification.variant === 'warning'">
                        <div x-data="{ isVisible: false, timeout: null }" x-cloak x-show="isVisible" class="pointer-events-auto relative rounded-md border border-amber-500 bg-white text-neutral-600" role="alert" x-on:pause-auto-dismiss.window="clearTimeout(timeout)" x-on:resume-auto-dismiss.window=" timeout = setTimeout(() => {(isVisible = false), removeNotification(notification.id) }, displayDuration)" x-init="$nextTick(() => { isVisible = true }), (timeout = setTimeout(() => { isVisible = false, removeNotification(notification.id)}, displayDuration))" x-transition:enter="transition duration-300 ease-out" x-transition:enter-end="translate-y-0" x-transition:enter-start="translate-y-8" x-transition:leave="transition duration-300 ease-in" x-transition:leave-end="-translate-x-24 opacity-0 md:translate-x-24" x-transition:leave-start="translate-x-0 opacity-100">
                            <div class="flex w-full items-center gap-2.5 bg-amber-500/10 rounded-md p-4 transition-all duration-300">

                                <!-- Icon -->
                                <div class="rounded-full bg-amber-500/15 p-0.5 text-amber-500" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <!-- Title & Message -->
                                <div class="flex flex-col gap-2">
                                    <h3  role="alert" aria-live="assertive" x-cloak x-show="notification.title" class="text-sm font-semibold text-amber-500" x-text="notification.title"></h3>
                                    <p  role="alert" aria-live="assertive" x-cloak x-show="notification.message" class="text-pretty text-sm" x-text="notification.message"></p>
                                </div>

                                <!--Dismiss Button -->
                                <button type="button" class="ml-auto" aria-label="dismiss notification" x-on:click="(isVisible = false), removeNotification(notification.id)">
                                    <x-heroicon-s-x-mark class="h-8"/>
                                </button>
                            </div>
                        </div>
                    </template>

                    <!-- Danger Notification  -->
                    <template x-if="notification.variant === 'danger'">
                        <div x-data="{ isVisible: false, timeout: null }" x-cloak x-show="isVisible" class="pointer-events-auto relative rounded-md border border-red-500 bg-white text-neutral-600 " role="alert" x-on:pause-auto-dismiss.window="clearTimeout(timeout)" x-on:resume-auto-dismiss.window=" timeout = setTimeout(() => {(isVisible = false), removeNotification(notification.id) }, displayDuration)" x-init="$nextTick(() => { isVisible = true }), (timeout = setTimeout(() => { isVisible = false, removeNotification(notification.id)}, displayDuration))" x-transition:enter="transition duration-300 ease-out" x-transition:enter-end="translate-y-0" x-transition:enter-start="translate-y-8" x-transition:leave="transition duration-300 ease-in" x-transition:leave-end="-translate-x-24 opacity-0 md:translate-x-24" x-transition:leave-start="translate-x-0 opacity-100">
                            <div class="flex w-full items-center gap-2.5 bg-red-500/10 rounded-md p-4 transition-all duration-300">

                                <!-- Icon -->
                                <div class="rounded-full bg-red-500/15 p-0.5 text-red-500" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <!-- Title & Message -->
                                <div class="flex flex-col gap-2">
                                    <h3  role="alert" aria-live="assertive" x-cloak x-show="notification.title" class="text-sm font-semibold text-red-500" x-text="notification.title"></h3>
                                    <p  role="alert" aria-live="assertive" x-cloak x-show="notification.message" class="text-pretty text-sm" x-text="notification.message"></p>
                                </div>

                                <!--Dismiss Button -->
                                <button type="button" class="ml-auto" aria-label="dismiss notification" x-on:click="(isVisible = false), removeNotification(notification.id)">
                                    <x-heroicon-s-x-mark class="h-8"/>
                                </button>
                            </div>
                        </div>
                    </template>

                    <!-- Message Notification  -->
                    <template x-if="notification.variant === 'message'">
                        <div x-data="{ isVisible: false, timeout: null }" x-cloak x-show="isVisible" class="pointer-events-auto relative rounded-md border border-neutral-300 bg-white text-neutral-600 " role="alert" x-on:pause-auto-dismiss.window="clearTimeout(timeout)" x-on:resume-auto-dismiss.window="timeout = setTimeout(() => { isVisible = false, removeNotification(notification.id) }, displayDuration)" x-init="$nextTick(() => { isVisible = true }), (timeout = setTimeout(() => { isVisible = false, removeNotification(notification.id) }, displayDuration))" x-transition:enter="transition duration-300 ease-out" x-transition:enter-end="translate-y-0" x-transition:enter-start="translate-y-8" x-transition:leave="transition duration-300 ease-in" x-transition:leave-end="-translate-x-24 opacity-0 md:translate-x-24" x-transition:leave-start="translate-x-0 opacity-100">
                            <div class="flex w-full rounded-md items-center gap-2.5 bg-neutral-50 p-4 transition-all duration-300">
                                <div class="flex w-full items-center gap-2.5">

                                    <!-- Avatar -->
                                    <img x-cloak x-show="notification.sender.avatar" class="mr-2 size-12 rounded-full" alt="avatar" aria-hidden="true" x-bind:src="notification.sender.avatar"/>
                                    <div class="flex flex-col items-start gap-2">
                                        <!-- Title & Message -->
                                        <h3 x-cloak x-show="notification.sender.name" class="text-sm font-semibold text-neutral-900" x-text="notification.sender.name"></h3>
                                        <p x-cloak x-show="notification.message" class="text-pretty text-sm" x-text="notification.message"></p>

                                        <!-- Action Buttons -->
                                        <div class="flex items-center gap-4">
                                            <button type="button" class="cursor-pointer whitespace-nowrap bg-transparent text-center text-sm font-bold tracking-wide text-black transition hover:opacity-75 active:opacity-100">Reply</button>
                                            <button type="button" class="cursor-pointer whitespace-nowrap bg-transparent text-center text-sm font-bold tracking-wide text-neutral-600 transition hover:opacity-75 active:opacity-100" x-on:click=" (isVisible = false), setTimeout(() => { removeNotification(notification.id) }, 400)">Dismiss</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dismiss Button -->
                                <button type="button" class="ml-auto" aria-label="dismiss notification" x-on:click="(isVisible = false), removeNotification(notification.id)">
                                    <x-heroicon-s-x-mark class="h-8"/>
                                </button>
                            </div>
                        </div>
                    </template>

                </div>
            </template>
        </div>
    </div>
</div>
