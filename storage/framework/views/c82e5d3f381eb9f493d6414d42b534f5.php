<footer class="footer <?php echo e(in_array(request()->route()->getName(), ['recipes', 'recipe.show']) ? 'has-full-line' : ''); ?>" role="contentinfo">
    <div class="wrapper">
        <div class="footer__content">
            
            <div class="footer__info">
                <p class="footer__text">
                    Made with ❤️ and 🥑
                </p>

            </div>

            
            <div class="footer__social">

                <ul class="footer__social-links">
                    <li>
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Follow us on Instagram">
                            <img width="24" height="24" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" src="<?php echo e(asset('assets/images/icon-instagram.svg')); ?>" alt="Instagram Icon" />
                        </a>
                    </li>
                    <li>
                        <a href="https://blueskyweb.xyz" target="_blank" rel="noopener noreferrer" aria-label="Follow us on BlueSky">
                            <img width="24" height="24" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" src="<?php echo e(asset('assets/images/icon-bluesky.svg')); ?>" alt="BlueSky Icon" />
                        </a>
                    </li>
                    <li>
                        <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" aria-label="Follow us on TikTok">
                            <img width="24" height="24" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" src="<?php echo e(asset('assets/images/icon-tiktok.svg')); ?>" alt="TikTok Icon" />
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer><?php /**PATH /Users/boghaert/sites/vulpo/recipe-finder/resources/views/components/footer.blade.php ENDPATH**/ ?>