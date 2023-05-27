<form wire:submit.prevent="sendMessage">
    <div class="grid grid-cols-1      filament-forms-component-container gap-6">
        <div class="col-span-full">
            <div>
                <div class="grid grid-cols-1   lg:grid-cols-2   filament-forms-component-container gap-6">
                    <div class="col-span-full">
                        <div>
                            <div class="grid grid-cols-1      filament-forms-component-container gap-6">
                                <div class="col-span-full">
                                    <div id="data.send-a-new-message-to-the-student"
                                         class="filament-forms-section-component rounded-xl border border-gray-300 bg-white dark:border-gray-600 dark:bg-gray-800">
                                        <div
                                            class="filament-forms-section-header-wrapper flex rtl:space-x-reverse overflow-hidden rounded-t-xl min-h-[56px] px-4 py-2 items-center bg-gray-100 dark:bg-gray-900">
                                            <div class="filament-forms-section-header flex-1 space-y-1">
                                                <h3 class="font-bold tracking-tight pointer-events-none flex flex-row items-center text-xl">

                                                    SEND A NEW ANNOUNCEMENT TO THE STUDENTS
                                                </h3>

                                            </div>

                                        </div>

                                        <div class="filament-forms-section-content-wrapper">
                                            <div class="filament-forms-section-content p-6">
                                                <div
                                                    class="grid grid-cols-1      filament-forms-component-container gap-6">
                                                    <div class="col-span-full">
                                                        {{ $this->form }}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit"
            style="margin-top: 1.5rem;"
            id="sending-btn"
            class="filament-button mt-6 inline-flex filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action"
    >
      <span
          id="sending-message"
      >
            Send
      </span>
    </button>
</form>
