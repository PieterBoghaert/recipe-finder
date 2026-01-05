# Modern Media Query Range Syntax - Implementation Guide

This project uses modern CSS media query range syntax with SCSS mixins for cleaner, more readable responsive code.

## Why Modern Range Syntax?

### Old Syntax (verbose, hard to read)

```scss
@media (min-width: 768px) {
}
@media (max-width: 767px) {
}
@media (min-width: 640px) and (max-width: 1023px) {
}
```

### Modern Range Syntax (clean, intuitive)

```scss
@media (width >= 768px) {
}
@media (width < 768px) {
}
@media (width >= 640px) and (width < 1024px) {
}
```

**Benefits:**

-   ✅ More readable (uses comparison operators)
-   ✅ Matches how we think about ranges
-   ✅ Less error-prone
-   ✅ Better developer experience
-   ✅ [90%+ browser support](https://caniuse.com/css-media-range-syntax) (all modern browsers)

## Available Mixins

### 1. Basic Breakpoint (min-width / mobile-first)

```scss
@include breakpoint(md) {
    // Styles for width >= 768px
}
```

**Breakpoints:**

-   `sm`: 640px
-   `md`: 768px
-   `lg`: 1024px
-   `xl`: 1280px
-   `xxl`: 1536px

### 2. Breakpoint Down (max-width)

```scss
@include breakpoint-down(md) {
    // Styles for width < 768px
}
```

### 3. Between Two Breakpoints

```scss
@include breakpoint-between(sm, lg) {
    // Styles for width >= 640px and width < 1024px
}
```

### 4. Exact Breakpoint Only

```scss
@include breakpoint-only(md) {
    // Styles for width >= 768px and width < 1024px
    // (md to lg, exclusive)
}
```

### 5. Custom Width Range

```scss
@include media-range(400px, 900px) {
    // Styles for width >= 400px and width < 900px
}

// Min only
@include media-range($min: 400px) {
    // Styles for width >= 400px
}

// Max only
@include media-range($max: 900px) {
    // Styles for width < 900px
}
```

### 6. Height Queries

```scss
@include height-range($min: 600px, $max: 800px) {
    // Styles for height >= 600px and height < 800px
}

@include height-range($min: 600px) {
    // Styles for height >= 600px
}
```

### 7. Aspect Ratio

```scss
@include aspect-ratio(16/9) {
    // Styles for aspect-ratio >= 16/9 (landscape)
}
```

### 8. Orientation

```scss
@include portrait {
    // Styles for portrait orientation
}

@include landscape {
    // Styles for landscape orientation
}
```

### 9. User Preferences

#### Reduced Motion

```scss
@include reduced-motion {
    // Disable/reduce animations for users who prefer reduced motion
    transition: none;
    animation: none;
}
```

**Automatically applied globally in `_boilerplate.scss`**

#### Color Scheme Preferences

```scss
@include prefers-dark {
    // Styles for users who prefer dark mode
}

@include prefers-light {
    // Styles for users who prefer light mode
}
```

## Real-World Examples

### Responsive Navigation

```scss
.navigation {
    display: flex;

    &__menu {
        display: flex;
        gap: var(--spacing-200);

        @include breakpoint-down(md) {
            // Mobile: stack vertically
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
        }
    }

    &__hamburger {
        display: none;

        @include breakpoint-down(md) {
            display: flex;
        }
    }
}
```

### Responsive Grid

```scss
.recipe-grid {
    display: grid;
    gap: var(--spacing-300);

    // Mobile: 1 column
    grid-template-columns: 1fr;

    // Tablet: 2 columns
    @include breakpoint(sm) {
        grid-template-columns: repeat(2, 1fr);
    }

    // Desktop: 3 columns
    @include breakpoint(lg) {
        grid-template-columns: repeat(3, 1fr);
    }

    // Large desktop: 4 columns
    @include breakpoint(xl) {
        grid-template-columns: repeat(4, 1fr);
    }
}
```

### Fluid Typography with Breakpoints

```scss
.hero-title {
    // Base (mobile)
    font-size: var(--fs-32);

    // Tablet and up
    @include breakpoint(md) {
        font-size: var(--fs-48);
    }

    // Desktop and up
    @include breakpoint(xl) {
        font-size: var(--fs-56);
    }
}
```

### Tablet-Only Styles

```scss
.feature {
    @include breakpoint-only(md) {
        // Only apply between 768px and 1024px
        padding: var(--spacing-400);
    }
}
```

### Landscape Video Container

```scss
.video-container {
    @include landscape {
        max-width: 80vw;
        max-height: 60vh;
    }

    @include portrait {
        max-width: 90vw;
        max-height: 50vh;
    }
}
```

### Respect Motion Preferences

```scss
.animated-card {
    transition: transform var(--transition-base);

    &:hover {
        transform: translateY(-4px);
    }

    // Users with reduced motion preference get instant changes
    @include reduced-motion {
        transition: none;

        &:hover {
            transform: none;
        }
    }
}
```

### Dark Mode Adjustments

```scss
.card {
    background: var(--color-surface-primary); // Uses light-dark() automatically

    // Additional dark-mode-only adjustments
    @include prefers-dark {
        border-width: 2px; // Thicker borders in dark mode for better definition
    }
}
```

### Complex Responsive Layout

```scss
.dashboard {
    display: grid;
    gap: var(--spacing-300);

    // Mobile: stack everything
    grid-template-columns: 1fr;
    grid-template-areas:
        "header"
        "sidebar"
        "main"
        "footer";

    // Small tablet: 2 columns
    @include breakpoint-between(sm, lg) {
        grid-template-columns: 200px 1fr;
        grid-template-areas:
            "header header"
            "sidebar main"
            "footer footer";
    }

    // Desktop: 3 columns with fixed sidebar
    @include breakpoint(lg) {
        grid-template-columns: 250px 1fr 250px;
        grid-template-areas:
            "header header header"
            "sidebar main aside"
            "footer footer footer";
    }
}
```

### Container Queries (Alternative Pattern)

```scss
// For component-level responsive design, use container queries
.card-container {
    container-type: inline-size;

    .card {
        display: flex;
        flex-direction: column;

        // When container is >= 400px wide, switch to row layout
        @container (width >= 400px) {
            flex-direction: row;
        }
    }
}
```

## Migration from Old Syntax

### Before (old min-width/max-width)

```scss
@media (min-width: 768px) {
    .element {
        font-size: 20px;
    }
}

@media (max-width: 767px) {
    .element {
        font-size: 16px;
    }
}

@media (min-width: 640px) and (max-width: 1023px) {
    .element {
        padding: 2rem;
    }
}
```

### After (modern range syntax with mixins)

```scss
@include breakpoint(md) {
    .element {
        font-size: 20px;
    }
}

@include breakpoint-down(md) {
    .element {
        font-size: 16px;
    }
}

@include breakpoint-between(sm, lg) {
    .element {
        padding: 2rem;
    }
}
```

## Testing in Browser DevTools

Modern range syntax is visible in browser DevTools:

**Chrome/Edge DevTools:**

```
Styles tab shows:
@media (width >= 48em) { ... }
```

You can toggle these on/off just like traditional media queries.

## Browser Support

| Feature      | Chrome | Firefox | Safari | Edge |
| ------------ | ------ | ------- | ------ | ---- |
| Range syntax | 104+   | 63+     | 16.4+  | 104+ |
| Support      | ✅     | ✅      | ✅     | ✅   |

**Global support: 90%+ (Feb 2024)**

Fallback not needed - all modern browsers (2022+) support this syntax.

## Best Practices

### 1. Mobile-First Approach

Start with mobile styles, then add larger breakpoints:

```scss
.element {
    // Mobile base styles
    font-size: 16px;

    // Tablet and up
    @include breakpoint(md) {
        font-size: 18px;
    }

    // Desktop and up
    @include breakpoint(lg) {
        font-size: 20px;
    }
}
```

### 2. Use Semantic Breakpoint Names

Don't think in pixels, think in devices:

-   `sm`: Phone (landscape) / Small tablet
-   `md`: Tablet
-   `lg`: Desktop / Laptop
-   `xl`: Large desktop
-   `xxl`: Ultra-wide displays

### 3. Prefer CSS Variables + Breakpoints Over Media Queries Everywhere

```scss
// ❌ Avoid
.card {
    @include breakpoint(md) {
        padding: 24px;
        border-radius: 12px;
    }
}

// ✅ Better
:root {
    --card-padding: #{rem(16)};
    --card-radius: #{rem(8)};

    @include breakpoint(md) {
        --card-padding: #{rem(24)};
        --card-radius: #{rem(12)};
    }
}

.card {
    padding: var(--card-padding);
    border-radius: var(--card-radius);
}
```

### 4. Respect User Preferences

Always include reduced motion support for animated elements:

```scss
.animated {
    transition: transform 0.3s;

    @include reduced-motion {
        transition: none;
    }
}
```

### 5. Test at Breakpoint Boundaries

Test your design at:

-   639px (just before sm)
-   640px (at sm)
-   767px (just before md)
-   768px (at md)
-   etc.

## Implementation in This Project

All media queries in this project use modern range syntax through mixins:

-   ✅ `global/_colors.scss` - Uses `@include prefers-light` and `@include prefers-dark`
-   ✅ `global/_boilerplate.scss` - Uses `@include reduced-motion`
-   ✅ `global/_layout.scss` - Uses `@include breakpoint()`
-   ✅ `components/_navigation.scss` - Uses `@include breakpoint-down(md)`
-   ✅ `components/_recipe-card.scss` - Uses `@include breakpoint()`
-   ✅ All other components follow the same pattern

## Resources

-   [MDN: CSS Media Query Range Syntax](https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_media_queries/Using_media_queries#syntax_improvements_in_level_4)
-   [Web.dev: Media Query Range Syntax](https://web.dev/articles/media-query-range-syntax)
-   [Can I Use: CSS Media Query Range Syntax](https://caniuse.com/css-media-range-syntax)
-   [CSS Working Group Draft](https://drafts.csswg.org/mediaqueries-4/#mq-range-context)
