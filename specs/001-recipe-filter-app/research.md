# Research: Recipe Filter Application

**Date**: 2026-01-05  
**Branch**: `001-recipe-filter-app`

## Overview

This document consolidates research findings for implementing the Recipe Filter Application. All technical unknowns from the Technical Context have been investigated, and decisions documented with rationale.

---

## 1. SCSS Architecture & Organization

### Decision: ITCSS (Inverted Triangle CSS) with 7 layers

**Rationale**:

- ITCSS provides a scalable, maintainable structure for component-heavy applications
- Natural specificity management prevents conflicts in large stylesheets
- Aligns with user's reference example (todo-livewire SCSS structure)
- Supports CSS @layer directive for explicit cascade control

**Implementation Structure**:

```
resources/scss/
├── 0-settings/      # Variables, design tokens (no CSS output)
│   ├── _colors.scss          # OKLCH color variables
│   ├── _typography.scss      # Font-size presets, clamp() values
│   ├── _spacing.scss         # Spacing scale tokens
│   └── _radius.scss          # Border-radius tokens
├── 1-tools/         # Mixins, functions (no CSS output)
│   ├── _mixins.scss          # Reusable mixins
│   └── _functions.scss       # SCSS functions
├── 2-generic/       # Reset, normalize, box-sizing
│   └── _reset.scss
├── 3-elements/      # Bare HTML elements (no classes)
│   ├── _page.scss            # html, body
│   ├── _typography.scss      # h1-h6, p, a
│   └── _forms.scss           # input, select, button
├── 4-objects/       # Layout patterns (OOCSS)
│   ├── _container.scss       # Max-width containers
│   ├── _grid.scss            # Grid layouts
│   └── _flex.scss            # Flexbox patterns
├── 5-components/    # UI components (BEM naming)
│   ├── _navigation.scss      # Header nav, hamburger menu
│   ├── _recipe-card.scss     # Recipe card component
│   ├── _filters.scss         # Filter dropdowns, search
│   ├── _button.scss          # Button variants
│   └── _footer.scss          # Footer component
├── 6-utilities/     # Helper classes, overrides
│   └── _utilities.scss       # margin, padding, display helpers
└── app.scss         # Main entry with @use imports and @layer definitions
```

**Alternatives Considered**:

- **Flat SCSS structure**: Rejected due to specificity conflicts and poor maintainability at scale
- **Atomic CSS (Tailwind-style)**: Rejected per user requirement and constitution (no CSS frameworks)
- **CSS Modules**: Rejected because Livewire + Blade doesn't require JS-based CSS scoping

---

## 2. OKLCH Color System Implementation

### Decision: SCSS variables with OKLCH color space

**Rationale**:

- OKLCH provides perceptually uniform colors (better than HSL)
- Supports modern browsers (Chrome 111+, Firefox 113+, Safari 15.4+)
- Enables color manipulation (lightness, chroma adjustments) via CSS calc()
- User-specified exact hex values converted to OKLCH for consistency

**Implementation**:

```scss
// 0-settings/_colors.scss
:root {
  // Neutral colors (converted from hex to OKLCH)
  --color-neutral-900: oklch(22.5% 0.02 170); // #163A34
  --color-neutral-600: oklch(38.6% 0.03 168); // #395852
  --color-neutral-300: oklch(85.2% 0.01 166); // #D0DCD9
  --color-neutral-200: oklch(90.1% 0.01 164); // #E0E6E3
  --color-neutral-100: oklch(96.3% 0 162); // #F6F5F1

  // Accent colors
  --color-orange-500: oklch(76.8% 0.14 45); // #FE9F6B
  --color-teal-500: oklch(65.3% 0.1 180); // #49AC9B
  --color-indigo-500: oklch(57.2% 0.12 270); // #697DDB
}
```

**Browser Support Strategy**:

- Primary: OKLCH variables
- Fallback: HEX/RGB for browsers without OKLCH support (via @supports)

**Alternatives Considered**:

- **RGB/HSL**: Rejected because not perceptually uniform (colors don't scale consistently)
- **CSS Color Module Level 4 (lch, lab)**: Rejected in favor of OKLCH which is better supported

---

## 3. Responsive Typography with clamp()

### Decision: CSS clamp() for fluid text scaling

**Rationale**:

- Eliminates media query breakpoints for font sizes
- Smooth scaling across viewport widths
- User specified mobile/tablet/desktop sizes map perfectly to clamp()
- Better performance (no JS required)

**Implementation Pattern**:

```scss
// 0-settings/_typography.scss
:root {
  // Formula: clamp(MIN, PREFERRED, MAX)
  // PREFERRED uses viewport width: calc(MINrem + (MAX - MIN) * ((100vw - 320px) / (1920 - 320)))

  --text-preset-1: clamp(
    3.25rem,
    3.25rem + 1.25vw,
    4.5rem
  ); // 52px → 64px → 72px
  --text-preset-2: clamp(
    2.5rem,
    2.5rem + 0.75vw,
    3.25rem
  ); // 40px → 48px → 52px
  --text-preset-3: 2rem; // 32px (static)
  --text-preset-4: 1.5rem; // 24px (static)
  --text-preset-5: 1.25rem; // 20px (static)
  --text-preset-6: 1.25rem; // 20px (static)
  --text-preset-7: 1.125rem; // 18px (static)
  --text-preset-8: 1rem; // 16px (static)
  --text-preset-9: 1rem; // 16px (static)
  --text-preset-10: 0.875rem; // 14px (static)
}
```

**Viewport Calculation**:

- Mobile base: 320px
- Desktop max: 1920px
- Linear interpolation between breakpoints

**Alternatives Considered**:

- **Media queries**: Rejected due to stepped changes (not smooth)
- **JS-based scaling**: Rejected per constitution (minimize JS)
- **rem + vw units**: Rejected because clamp() provides better min/max control

---

## 4. Nunito Font Loading (woff2)

### Decision: Self-hosted woff2 fonts with @font-face

**Rationale**:

- woff2 format provides best compression (~30% smaller than woff)
- Self-hosting avoids external dependency (Google Fonts)
- Better performance (no DNS lookup, CORS issues)
- User-provided fonts in starter-code need conversion to woff2

**Implementation**:

```scss
// 3-elements/_typography.scss
@font-face {
  font-family: "Nunito";
  src: url("/assets/fonts/Nunito/Nunito-Regular.woff2") format("woff2");
  font-weight: 400;
  font-style: normal;
  font-display: swap;
}

@font-face {
  font-family: "Nunito";
  src: url("/assets/fonts/Nunito/Nunito-Bold.woff2") format("woff2");
  font-weight: 700;
  font-style: normal;
  font-display: swap;
}

// Base body font
body {
  font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}
```

**Font Conversion Process**:

- Convert existing OTF/TTF files to woff2 using fonttools or online converter
- Keep only necessary weights (400, 700) to reduce bundle size

**Alternatives Considered**:

- **Google Fonts CDN**: Rejected for performance and dependency reasons
- **Variable fonts**: Rejected because Nunito variable font may not include all weights needed

---

## 5. Pure CSS Hamburger Menu (No JavaScript)

### Decision: Checkbox hack for mobile navigation toggle

**Rationale**:

- CSS-only solution meets user requirement (no JS)
- Accessible (keyboard navigable via tab + space)
- Performant (no event listeners or DOM manipulation)
- Simple implementation with sibling selector

**Implementation Pattern**:

```scss
// 5-components/_navigation.scss
.nav {
  &__toggle {
    display: none; // Hide checkbox

    &:checked ~ .nav__menu {
      display: block; // Show menu when checked
    }
  }

  &__label {
    display: none; // Hide on desktop
    cursor: pointer;

    @media (max-width: 768px) {
      display: block; // Show hamburger icon on mobile
    }
  }

  &__menu {
    @media (max-width: 768px) {
      display: none; // Hide menu by default on mobile
      position: absolute;
      top: 100%;
      left: 0;
      width: 100%;
      background: var(--color-neutral-100);
    }
  }
}
```

**HTML Structure**:

```html
<nav class="nav">
  <input type="checkbox" id="nav-toggle" class="nav__toggle" />
  <label for="nav-toggle" class="nav__label">☰</label>
  <ul class="nav__menu">
    <li><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
    <li><a href="/recipes">Recipes</a></li>
  </ul>
</nav>
```

**Accessibility Considerations**:

- Checkbox is keyboard accessible (tab to focus, space to toggle)
- Label provides click target
- Menu items remain keyboard navigable when expanded

**Alternatives Considered**:

- **JavaScript toggle**: Rejected per user requirement (no JS for menu)
- **:target pseudo-class**: Rejected because adds URL hash on toggle (poor UX)
- **details/summary elements**: Rejected because limited styling control for horizontal nav

---

## 6. View Transitions API for Filter Animations

### Decision: Use View Transitions API for smooth filter state changes

**Rationale**:

- Native browser API (Chrome 111+, Edge 111+, Safari 18+)
- Provides smooth transitions between DOM states
- Better performance than CSS transitions alone
- Requires minimal JavaScript (just triggering transition)

**Implementation**:

```javascript
// resources/js/components/recipe-filters.js
document.addEventListener("livewire:navigated", () => {
  if ("startViewTransition" in document) {
    document.startViewTransition(() => {
      // Livewire updates DOM here
    });
  }
});
```

```css
/* 5-components/_recipe-card.scss */
@view-transition {
  navigation: auto;
}

.recipe-card {
  view-transition-name: var(--recipe-card-id);
}

::view-transition-old(root),
::view-transition-new(root) {
  animation-duration: 0.3s;
  animation-timing-function: ease-in-out;
}
```

**Livewire Integration**:

- Hook into Livewire's wire:navigate for SPA-like transitions
- Graceful degradation for unsupported browsers (instant updates)

**Alternatives Considered**:

- **CSS transitions only**: Rejected because doesn't provide cross-state morphing
- **FLIP animations**: Rejected because View Transitions API provides better DX and performance
- **Framer Motion / GSAP**: Rejected per constitution (minimal dependencies)

---

## 7. Data Storage Strategy

### Decision: Import data.json into database via Laravel seeder

**Rationale**:

- Database enables efficient filtering and searching (SQL queries)
- Eloquent ORM provides clean API for Livewire components
- Better performance than JSON file parsing on each request
- Enables future features (user-submitted recipes, favorites)

**Migration Structure**:

```php
// database/migrations/create_recipes_table.php
Schema::create('recipes', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('overview')->nullable();
    $table->integer('servings');
    $table->integer('prep_minutes');
    $table->integer('cook_minutes');
    $table->string('image_large');
    $table->string('image_small');
    $table->json('ingredients'); // Array stored as JSON
    $table->json('instructions'); // Array stored as JSON
    $table->timestamps();
});
```

**Seeder Implementation**:

```php
// database/seeders/RecipeSeeder.php
public function run()
{
    $json = File::get(base_path('starter-code/data.json'));
    $recipes = json_decode($json, true);

    foreach ($recipes as $recipe) {
        Recipe::create([
            'title' => $recipe['title'],
            'slug' => $recipe['slug'],
            // ... map all fields
        ]);
    }
}
```

**Query Performance**:

- Index on `prep_minutes` and `cook_minutes` for filter queries
- Full-text search on `title` and `ingredients` JSON column
- SQLite for development (simple setup), PostgreSQL/MySQL for production (better JSON support)

**Alternatives Considered**:

- **JSON file parsing**: Rejected due to poor performance and no query capabilities
- **GraphQL API**: Rejected as over-engineering for this scale (50 recipes)
- **REST API**: Rejected because Livewire handles data fetching internally (no separate API needed)

---

## 8. Laravel Livewire Component Strategy

### Decision: Three main Livewire components for reactive UI

**Rationale**:

- Livewire enables reactive UI without heavy JavaScript frameworks
- Server-side rendering with hydration (better SEO, initial load)
- Aligns with constitution (minimal dependencies)

**Component Architecture**:

1. **RecipeList Component** (`app/Http/Livewire/RecipeList.php`)
   - Displays recipe grid/list
   - Handles pagination
   - Listens for filter changes from RecipeFilters
2. **RecipeFilters Component** (`app/Http/Livewire/RecipeFilters.php`)
   - Search input with wire:model.debounce.300ms
   - Prep time dropdown
   - Cook time dropdown
   - Emits filter changes to RecipeList
3. **RecipeDetail Component** (`app/Http/Livewire/RecipeDetail.php`)
   - Displays single recipe
   - Generates 3 random related recipes (excluding current)

**Data Flow**:

```
RecipeFilters (search, prepTime, cookTime)
    ↓ (emits: filtersChanged)
RecipeList (receives filters, queries DB, updates view)
```

**Livewire Benefits**:

- Real-time search with `wire:model.debounce.300ms`
- No manual API calls or state management
- Automatic CSRF protection
- Built-in validation

**Alternatives Considered**:

- **Alpine.js + Blade**: Rejected because requires more manual state management
- **Vue/React**: Rejected per user requirement and constitution
- **Plain PHP with AJAX**: Rejected due to poor DX and more boilerplate

---

## 9. Responsive Design Strategy

### Decision: Mobile-first CSS with container queries and fluid spacing

**Rationale**:

- Mobile-first ensures core content accessible on smallest screens
- Container queries provide component-level responsiveness (better than media queries)
- Fluid spacing scale prevents breakpoint jumps

**Breakpoint Strategy**:

```scss
// 0-settings/_breakpoints.scss
$breakpoint-sm: 640px; // Small tablets
$breakpoint-md: 768px; // Tablets
$breakpoint-lg: 1024px; // Small desktops
$breakpoint-xl: 1280px; // Large desktops
$breakpoint-2xl: 1536px; // Extra large desktops

// Mobile-first media query mixin
@mixin respond-to($breakpoint) {
  @media (min-width: $breakpoint) {
    @content;
  }
}
```

**Container Queries** (for recipe cards):

```scss
// 4-objects/_grid.scss
.recipe-grid {
  container-type: inline-size;
  container-name: recipe-grid;
  display: grid;
  gap: var(--spacing-400);
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
}

// 5-components/_recipe-card.scss
.recipe-card {
  @container recipe-grid (min-width: 768px) {
    display: flex; // Horizontal layout on wider containers
  }
}
```

**Touch Targets**:

- Minimum 44x44px for all interactive elements (buttons, links, form controls)
- Adequate spacing between tap targets (min 8px)

**Alternatives Considered**:

- **Desktop-first**: Rejected because mobile usage often exceeds desktop for recipe sites
- **Media queries only**: Rejected because container queries provide better component isolation
- **Fixed breakpoints**: Rejected in favor of fluid approach with clamp() and flexible grids

---

## 10. Filter Customization (Customizable Select)

### Decision: Native select with CSS styling (appearance: none)

**Rationale**:

- Native select provides best accessibility (keyboard navigation, screen readers)
- CSS appearance: none removes browser defaults for custom styling
- Livewire wire:model provides reactive binding
- No JavaScript library needed

**Implementation**:

```scss
// 5-components/_filters.scss
.filter {
  &__select {
    appearance: none;
    background: var(--color-neutral-100);
    border: 1px solid var(--color-neutral-300);
    border-radius: var(--radius-8);
    padding: var(--spacing-150) var(--spacing-400) var(--spacing-150) var(
        --spacing-200
      );
    font-size: var(--text-preset-9);
    cursor: pointer;

    // Custom dropdown arrow
    background-image: url("data:image/svg+xml,...");
    background-repeat: no-repeat;
    background-position: right var(--spacing-200) center;
    background-size: 12px;

    &:hover {
      border-color: var(--color-teal-500);
    }

    &:focus {
      outline: 2px solid var(--color-teal-500);
      outline-offset: 2px;
    }
  }
}
```

**Livewire Binding**:

```html
<select wire:model.live="maxPrepTime" class="filter__select">
  <option value="">Any prep time</option>
  <option value="10">10 minutes</option>
  <option value="15">15 minutes</option>
  <option value="30">30 minutes</option>
  <option value="60">60 minutes</option>
</select>
```

**Alternatives Considered**:

- **Custom dropdown with radio buttons**: Rejected due to complexity and accessibility challenges
- **Third-party select library (Select2, Choices.js)**: Rejected per constitution (minimal dependencies)
- **details/summary for dropdown**: Rejected because poor semantic fit and styling limitations

---

## 11. Related Recipes Logic

### Decision: Random selection excluding current recipe

**Rationale**:

- Simple algorithm provides variety
- Excludes current recipe to avoid redundancy
- Handles edge case (<3 available recipes)

**Implementation**:

```php
// app/Http/Livewire/RecipeDetail.php
public function getRelatedRecipesProperty()
{
    $count = min(3, Recipe::count() - 1); // Max 3, account for current recipe

    return Recipe::where('id', '!=', $this->recipe->id)
        ->inRandomOrder()
        ->limit($count)
        ->get();
}
```

**Future Enhancement Options** (not for MVP):

- Similar prep/cook times
- Shared ingredients
- Same cuisine category (if added)

**Alternatives Considered**:

- **Ingredient-based similarity**: Rejected as over-engineering for MVP (50 recipes)
- **Category-based**: Rejected because data.json doesn't include categories
- **Most viewed**: Rejected because requires analytics tracking (out of scope)

---

## 12. Image Handling & Optimization

### Decision: Responsive images with picture element and webp format

**Rationale**:

- data.json provides large/small image variants
- Picture element enables art direction
- Webp provides better compression than JPEG/PNG
- Lazy loading improves initial page load

**Implementation**:

```html
<!-- resources/views/livewire/recipe-card.blade.php -->
<picture class="recipe-card__image">
  <source
    media="(min-width: 768px)"
    srcset="{{ asset($recipe->image_large) }}"
    type="image/webp"
  />
  <img
    src="{{ asset($recipe->image_small) }}"
    alt="{{ $recipe->title }}"
    loading="lazy"
    width="400"
    height="300"
  />
</picture>
```

**Fallback Strategy**:

```scss
// 5-components/_recipe-card.scss
.recipe-card__image {
  background: var(--color-neutral-200); // Fallback if image fails

  img {
    width: 100%;
    height: auto;
    object-fit: cover;
    aspect-ratio: 4 / 3;
  }
}
```

**Missing Image Handling**:

- CSS background color provides visual placeholder
- Alt text describes expected content
- Consider adding default placeholder SVG for production

**Alternatives Considered**:

- **Single image with srcset**: Rejected because data.json provides distinct large/small images (not just different sizes)
- **Client-side image optimization**: Rejected because server-side optimization (Vite, Imagick) is more efficient
- **External image service (Cloudinary)**: Rejected per constitution (minimal dependencies)

---

## Technology Decisions Summary

| Decision Area         | Technology/Approach              | Primary Reason                         |
| --------------------- | -------------------------------- | -------------------------------------- |
| **CSS Architecture**  | ITCSS (7 layers)                 | Scalable specificity management        |
| **Color System**      | OKLCH CSS variables              | Perceptual uniformity + manipulation   |
| **Typography**        | clamp() for fluid scaling        | Smooth responsive text without MQ      |
| **Font Loading**      | Self-hosted woff2                | Performance + no external dependency   |
| **Mobile Navigation** | Checkbox hack (CSS-only)         | No JS requirement                      |
| **Filter Animations** | View Transitions API             | Native browser API, smooth transitions |
| **Data Storage**      | Database (SQLite/PostgreSQL)     | Query performance + future scalability |
| **Reactive UI**       | Laravel Livewire 3.x             | Minimal JS, server-side rendering      |
| **Responsive Design** | Mobile-first + container queries | Component-level responsiveness         |
| **Form Controls**     | Native select with CSS styling   | Accessibility + no dependencies        |
| **Related Recipes**   | Random selection (SQL)           | Simple, provides variety               |
| **Images**            | Picture element + lazy loading   | Responsive images, better performance  |

---

## Implementation Phases

Based on research findings, implementation should proceed in this order:

**Phase 1: Foundation**

1. Laravel installation and configuration
2. Database migration and seeder (import data.json)
3. SCSS structure setup with design tokens
4. Font conversion and loading

**Phase 2: Core Pages**

1. Layout blade template (nav, footer)
2. Home page (static content)
3. About page (static content)
4. Recipe model and basic routes

**Phase 3: Recipe List & Filtering**

1. RecipeList Livewire component
2. RecipeFilters Livewire component
3. Recipe card component
4. Filter logic and search implementation

**Phase 4: Recipe Detail**

1. RecipeDetail Livewire component
2. Related recipes logic
3. Detailed recipe view

**Phase 5: Polish**

1. View Transitions API integration
2. Image optimization
3. Accessibility audit
4. Mobile menu refinement

---

## Open Questions for Clarification

_All critical technical decisions have been resolved. No blocking questions remain._

**Nice-to-have enhancements** (deferred to post-MVP):

- Should recipe cards show tags/categories? (Not in data.json)
- Should there be a "favorites" or "save recipe" feature?
- Should related recipes persist on page refresh or re-randomize?

---

## References

- [ITCSS Architecture](https://www.xfive.co/blog/itcss-scalable-maintainable-css-architecture/)
- [OKLCH Color Space](https://evilmartians.com/chronicles/oklch-in-css-why-quit-rgb-hsl)
- [CSS clamp() for Typography](https://www.smashingmagazine.com/2022/01/modern-fluid-typography-css-clamp/)
- [View Transitions API](https://developer.chrome.com/docs/web-platform/view-transitions/)
- [Laravel Livewire Documentation](https://livewire.laravel.com/docs/)
- [todo-livewire SCSS structure reference](https://github.com/PieterBoghaert/todo-livewire/tree/master/resources/scss)

---

**Research Complete**: All technical unknowns resolved. Ready to proceed to Phase 1 (Data Model & Contracts).
