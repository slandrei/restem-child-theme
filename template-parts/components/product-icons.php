<?php
/** @var $args */

$is_vegetarian = $args['is_vegetarian'];

?>

<!-- Icons -->
<div class="absolute top-3 left-3">
	<?php if ( $is_vegetarian ) : ?>
        <div class="bg-kubio-color-1-variant-4 p-2 rounded-lg shadow-sm" data-tippy-content="Vegetarian">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
            </svg>
        </div>
	<?php else: ?>
        <!-- Placeholder leaf icon as seen in image -->
        <div class="bg-kubio-color-1-variant-4 backdrop-blur-sm p-2 rounded-lg shadow-sm" data-tippy-content="Non-Vegetarian">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 12C2 12 5 2 12 2C12 2 19 2 22 5C22 5 22 12 12 12C12 12 22 12 22 19C22 19 22 22 19 22C19 22 12 22 12 12C12 12 12 22 5 22C5 22 2 22 2 19C2 19 2 12 12 12C12 12 2 12 2 5C2 5 2 2 5 2C5 2 12 2 12 12"
                      stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
	<?php endif; ?>
</div>
