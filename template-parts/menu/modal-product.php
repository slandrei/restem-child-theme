<?php

?>

<dialog id="product-modal"
        class="rounded-[2rem] bg-white p-0 max-w-lg w-full max-h-[90vh] overflow-visible fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 shadow-2xl border-0 backdrop:bg-black/40">


    <div class="tw relative flex flex-col h-[min(90vh,90vh)]">
        <form method="dialog">
            <button class="absolute -top-4 -right-4 z-50 bg-white/80 backdrop-blur-sm w-10 h-10 rounded-full flex items-center justify-center text-gray-800 hover:bg-white transition-colors shadow-sm">
                ✕
            </button>
        </form>

        <div id="product-modal-content" class="flex flex-col min-h-0 h-full">
            <div class="grid place-items-center min-h-[400px]">
                <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-[#B45309]"></div>
            </div>
        </div>
    </div>
</dialog>

