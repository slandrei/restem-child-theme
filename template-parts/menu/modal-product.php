<?php

?>

<dialog id="product-modal"
        class="tw rounded-[2rem] bg-white p-0 max-w-lg w-full overflow-hidden fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 shadow-2xl border-0 backdrop:bg-black/40">
    <div class="relative h-full flex flex-col">
        <form method="dialog">
            <button class="absolute top-4 right-4 z-50 bg-white/80 backdrop-blur-sm w-10 h-10 rounded-full flex items-center justify-center text-gray-800 hover:bg-white transition-colors shadow-sm">
                ✕
            </button>
        </form>

        <div class="grid place-items-center min-h-[400px] empty:hidden [&:has(~#product-modal-content:not(:empty))]:hidden">
            <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-[#B45309]"></div>
        </div>

        <div id="product-modal-content" class="flex-grow overflow-y-auto custom-scrollbar"></div>
    </div>
</dialog>

