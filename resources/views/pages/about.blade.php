<x-layouts.app title="About - Recipe Finder" pageClass="page-about">

    <section class="about-mission">
        <div class="wrapper">
            <div class="about-mission__grid">
                <div class="about-mission__text animate-on-scroll animate-fade-in-up">
                    <h5 class="about-mission__tag">Our Mission</h5>
                    <h2>Help more people cook nourishing meals,
                        more often.</h2>
                    <p>Healthy Recipe Finder was created to prove that healthy eating can be convenient, affordable, and genuinely delicious.</p>
                    <p>We showcase quick, whole-food dishes that anyone can master—no fancy equipment, no ultra-processed shortcuts—just honest ingredients and straightforward steps.</p>
                </div>
                <div class="about-mission__figure animate-on-scroll animate-scale-in animate-delay-1">
                    <picture>
                        <source srcset="{{ asset('assets/images/image-about-our-mission-large.webp') }}" media="(min-width: 640px)">
                        <img src="{{ asset('assets/images/image-about-our-mission-small.webp') }}" alt="Delicious healthy meal" class="about-mission__image" width="686" height="667">
                    </picture>
                </div>
            </div>

        </div>
    </section>

    <section class="about-whyweexist">
        <div class="wrapper">
            <div class="about-whyweexist__grid">
                <h2 class="about-whyweexist__title animate-on-scroll animate-fade-in-up">Why we exist</h2>

                <dl class="about-whyweexist__text">
                    <div class="about-whyweexist__item animate-on-scroll animate-fade-in-up animate-delay-1">
                        <dt class="h4">Whole ingredients first.</dt>
                        <dd>Fresh produce, grains, legumes, herbs, and quality fats form the backbone of every recipe.</dd>
                    </div>

                    <div class="about-whyweexist__item animate-on-scroll animate-fade-in-up animate-delay-2">
                        <dt class="h4">Flavor without compromise.</dt>
                        <dd>Spices, citrus, and natural sweetness replace excess salt, sugar, and additives.</dd>
                    </div>

                    <div class="about-whyweexist__item animate-on-scroll animate-fade-in-up animate-delay-3">
                        <dt class="h4">Respect for time.</dt>
                        <dd>Weeknight meals should slot into real schedules; weekend cooking can be leisurely but never wasteful.</dd>
                    </div>

                    <div class="about-whyweexist__item animate-on-scroll animate-fade-in-up animate-delay-4">
                        <dt class="h4">Sustainable choices.</dt>
                        <dd>Short ingredient lists cut down on food waste and carbon footprint, while plant-forward dishes keep things planet-friendly.</dd>
                    </div>
                </dl>

            </div>
    </section>

    <section class="about-philosophy">
        <div class="wrapper">
            <div class="about-philosophy__grid">
                <h2 class="about-philosophy__title animate-on-scroll animate-fade-in-up">Our food philosophy</h2>

                <dl class="about-philosophy__text">
                    <div class="about-philosophy__item animate-on-scroll animate-fade-in-up animate-delay-1">
                        <dt class="h4">Cut through the noise.</dt>
                        <dd>The internet is bursting with recipes, yet most busy cooks still default to take-away or packaged foods. We curate a tight collection of fool-proof dishes so you can skip the scrolling and start cooking.</dd>
                    </div>
                    <div class="about-philosophy__item animate-on-scroll animate-fade-in-up animate-delay-2">
                        <dt class="h4">Empower home kitchens.</dt>
                        <dd>When you control what goes into your meals, you control how you feel. Every recipe is built around unrefined ingredients and ready in about half an hour of active prep.</dd>
                    </div>
                    <div class="about-philosophy__item animate-on-scroll animate-fade-in-up animate-delay-3">
                        <dt class="h4">Make healthy look good.</dt>
                        <dd>High-resolution imagery shows you exactly what success looks like—because we eat with our eyes first, and confidence matters.</dd>
                    </div>
                </dl>

            </div>
    </section>

    <section class="about-beyond">
        <div class="wrapper">
            <div class="about-beyond__grid">
                <div class="about-beyond__text animate-on-scroll animate-fade-in-up">
                    <h2>Beyond the plate</h2>
                    <p>We believe food is a catalyst for community and well-being. By sharing approachable recipes, we hope to:</p>
                    <ul class="about-beyond__list">
                        <li>Encourage family dinners and social cooking.</li>
                        <li>Reduce reliance on single-use packaging and delivery waste.</li>
                        <li>Spark curiosity about seasonal produce and local agriculture.</li>
                    </ul>
                </div>
                <div class="about-beyond__figure animate-on-scroll animate-scale-in animate-delay-1">
                    <picture>
                        <source srcset="{{ asset('assets/images/image-about-beyond-the-plate-large.webp') }}" media="(min-width: 640px)">
                        <img src="{{ asset('assets/images/image-about-beyond-the-plate-small.webp') }}" alt="Delicious healthy meal" class="about-beyond__image" width="686" height="369">
                    </picture>
                </div>
            </div>

        </div>
    </section>

    <x-cta />

</x-layouts.app>