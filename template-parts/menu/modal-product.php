<?php

?>

<dialog
        id="product-modal"
        class="tw rounded-2xl bg-white p-0 max-w-[calc(100%-40px)] md:max-w-[520px] w-full max-h-[calc(90vh-40px)] md:max-h-[90vh] overflow-visible fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 shadow-2xl border-0 backdrop:bg-black/85 "
>
    <div class="relative flex flex-col [&:has(.restem-spinner)]:min-h-[25vh]]">
        <form method="dialog">
            <button class="absolute -top-4 -right-4 z-50 bg-white/80 backdrop-blur-md w-10 h-10 rounded-full flex items-center justify-center text-gray-800 hover:bg-white transition-colors shadow-sm">
                ✕
            </button>
        </form>

        <div id="product-modal-content" class="flex flex-col min-h-0 h-full pt-4"></div>
    </div>

</dialog>

