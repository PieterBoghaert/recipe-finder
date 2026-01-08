# Feature Specification: Recipe Filter Application

**Feature Branch**: `001-recipe-filter-app`  
**Created**: 2025-12-28  
**Status**: Draft  
**Input**: User description: "initial page setup - this application should be a recipe filter app with a main dashboard where they see a list of recipe blocks (with picture, title, description, servings, preparation time, cook time and a view recipe button where they should go to the details page)"

## User Scenarios & Testing _(mandatory)_

### User Story 1 - Browse and View Recipes (Priority: P1)

A user visits the recipe application to discover recipes. They can see a collection of recipe cards displaying key information (picture, title, description, servings, preparation time, cook time) and navigate to detailed recipe information.

**Why this priority**: This is the core value proposition - users must be able to browse and view recipes. Without this, the application has no purpose.

**Independent Test**: Can be fully tested by loading the recipes page, viewing the list of recipe cards with all required information, clicking "View Recipe" on any card, and verifying that the detail page displays complete recipe information including related recipes.

**Acceptance Scenarios**:

1. **Given** a user visits the recipes page, **When** the page loads, **Then** they see a grid/list of recipe cards, each displaying a picture, title, description, servings, preparation time, cook time, ingredient count, and a "View Recipe" button
2. **Given** a user is viewing the recipes list, **When** they click the "View Recipe" button on any recipe card, **Then** they are taken to a detail page showing the full recipe information
3. **Given** a user is on a recipe detail page, **When** the page loads, **Then** they see all recipe information (picture, title, description, servings, preparation time, cook time, full ingredient list, cooking instructions) plus a section with 3 related recipe cards
4. **Given** a user is viewing any page, **When** they interact with the interface on different devices (desktop, tablet, mobile), **Then** the layout adapts optimally to their screen size

---

### User Story 2 - Filter Recipes by Time (Priority: P2)

A user wants to find recipes that fit their available cooking time. They can use filter controls to limit recipes based on maximum preparation time and maximum cook time.

**Why this priority**: Filtering by time is a critical feature for users with time constraints (meal planning, quick dinners), making recipe discovery more useful and personalized.

**Independent Test**: Can be fully tested by navigating to the recipes page, selecting different max prep time and max cook time values from the filter dropdowns, and verifying that only recipes meeting the selected criteria are displayed.

**Acceptance Scenarios**:

1. **Given** a user is on the recipes page, **When** they view the filter area above the recipe list, **Then** they see two dropdown selects (one for max preparation time, one for max cook time) and a search field
2. **Given** a user selects "30 minutes" from the max preparation time filter, **When** the filter is applied, **Then** only recipes with preparation time of 30 minutes or less are displayed
3. **Given** a user selects "45 minutes" from the max cook time filter, **When** the filter is applied, **Then** only recipes with cook time of 45 minutes or less are displayed
4. **Given** a user has applied both prep time and cook time filters, **When** both filters are active, **Then** only recipes meeting both criteria are displayed
5. **Given** a user has applied filters, **When** they clear or change the filter values, **Then** the recipe list updates accordingly

---

### User Story 3 - Search for Recipes (Priority: P2)

A user wants to find specific recipes by name or ingredient. They can use a search field to filter the recipe list based on their search query.

**Why this priority**: Search functionality is essential for users who know what they're looking for or want to find recipes containing specific ingredients they have on hand.

**Independent Test**: Can be fully tested by entering various search terms (recipe names, ingredients) into the search field and verifying that only matching recipes are displayed.

**Acceptance Scenarios**:

1. **Given** a user is on the recipes page, **When** they type a recipe name into the search field, **Then** the recipe list filters in real-time to show only recipes with matching names (after ~300ms debounce delay)
2. **Given** a user is on the recipes page, **When** they type an ingredient into the search field, **Then** the recipe list filters in real-time to show only recipes containing that ingredient (after ~300ms debounce delay)
3. **Given** a user has entered a search term, **When** they clear the search field, **Then** all recipes are displayed again
4. **Given** a user has applied both search and time filters, **When** all filters are active, **Then** only recipes meeting all criteria are displayed

---

### User Story 4 - Navigate Between Pages (Priority: P1)

A user wants to explore different sections of the recipe application. They can use the navigation bar to access the home page, about page, and recipes page, and can trigger recipe browsing from multiple entry points.

**Why this priority**: Navigation is foundational for any multi-page application - users must be able to move between sections to access content.

**Independent Test**: Can be fully tested by clicking each navigation link (logo, Home, About, Recipes, Browse Recipes button) and verifying that the correct page loads.

**Acceptance Scenarios**:

1. **Given** a user is on any page, **When** they view the navigation bar, **Then** they see a logo, navigation links (Home, About, Recipes), and a "Browse Recipes" button (separate from main navigation)
2. **Given** a user clicks the logo, **When** the click is processed, **Then** they are taken to the home page
3. **Given** a user clicks "Home" in the navigation, **When** the click is processed, **Then** they are taken to the home page
4. **Given** a user clicks "About" in the navigation, **When** the click is processed, **Then** they are taken to the about page
5. **Given** a user clicks "Recipes" in the navigation, **When** the click is processed, **Then** they are taken to the recipes index page
6. **Given** a user clicks the "Browse Recipes" button, **When** the click is processed, **Then** they are taken to the recipes index page

---

### User Story 5 - Interactive Feedback (Priority: P3)

A user interacts with various elements on the site (buttons, links, form controls). They receive visual feedback through hover and focus states to confirm their interactions.

**Why this priority**: Interactive feedback improves usability and accessibility, but the application is still functional without it. It enhances the user experience rather than enabling core functionality.

**Independent Test**: Can be fully tested by hovering over and focusing on all interactive elements (navigation links, buttons, search field, filter dropdowns) and verifying that appropriate visual feedback is displayed.

**Acceptance Scenarios**:

1. **Given** a user hovers over any interactive element (link, button, form control), **When** the hover occurs, **Then** a hover state is displayed
2. **Given** a user tabs through the page or clicks into form controls, **When** an element receives focus, **Then** a focus state is displayed
3. **Given** a user interacts with the "View Recipe" buttons, **When** they hover or focus on the button, **Then** appropriate visual feedback is shown

---

### User Story 6 - View Footer Information (Priority: P3)

A user reaches the bottom of any page and can see footer content including informational text and links to social media channels.

**Why this priority**: Footer content provides supplementary information and social connections but is not critical to core recipe browsing functionality.

**Independent Test**: Can be fully tested by scrolling to the bottom of any page and verifying the presence of footer text and social media icons with correct links.

**Acceptance Scenarios**:

1. **Given** a user scrolls to the bottom of any page, **When** the footer is visible, **Then** they see small informational text and social media icons (Instagram, Twitter, TikTok) aligned to the right
2. **Given** a user clicks on a social media icon, **When** the click is processed, **Then** they are taken to the corresponding social media profile

---

### Edge Cases

-   What happens when a user applies filters that result in zero matching recipes? (Filters persist; message displayed)
-   How does the system handle recipe images that fail to load or are missing?
-   What happens when a user searches for a term with no matches? (Search term and filters persist; message displayed)
-   How does the application handle related recipes when fewer than 3 related recipes are available?
-   What happens when recipe data is incomplete (missing prep time, cook time, or other fields)?
-   How does the search field handle special characters or very long search terms?
-   What happens when a user navigates directly to a recipe detail page URL that doesn't exist?

## Requirements _(mandatory)_

### Functional Requirements

**Page Structure & Navigation**

-   **FR-001**: Application MUST provide a home page that serves as the main entry point
-   **FR-002**: Application MUST provide an about page with information about the application
-   **FR-003**: Application MUST provide a recipes index page displaying all available recipes
-   **FR-004**: Application MUST provide individual recipe detail pages for each recipe
-   **FR-005**: Application MUST display a navigation bar on all pages containing a logo, navigation links (Home, About, Recipes), and a "Browse Recipes" button
-   **FR-006**: Application MUST navigate users to the home page when they click the logo or Home link
-   **FR-007**: Application MUST navigate users to the recipes index page when they click Recipes link or Browse Recipes button
-   **FR-008**: Application MUST display a footer on all pages containing informational text and social media icons (Instagram, Twitter, TikTok)

**Recipe Display**

-   **FR-009**: Recipe index page MUST display recipes as cards in a grid or list layout
-   **FR-010**: Each recipe card MUST display: picture, title, description, servings, preparation time, cook time, ingredient count, and a "View Recipe" button
-   **FR-011**: Recipe detail page MUST display all recipe information: picture, title, description, servings, preparation time, cook time, full ingredient list, and cooking instructions as free-form text
-   **FR-012**: Recipe detail page MUST include a "Related Recipes" section displaying 3 randomly selected recipe cards from all available recipes (excluding the current recipe)
-   **FR-013**: Related recipe cards MUST follow the same format as cards on the recipes index page

**Search & Filter Functionality**

-   **FR-014**: Recipes index page MUST provide a filter area positioned above the recipe list
-   **FR-015**: Filter area MUST include a search field for entering search queries
-   **FR-016**: Filter area MUST include a dropdown select for maximum preparation time
-   **FR-017**: Filter area MUST include a dropdown select for maximum cook time
-   **FR-018**: Application MUST filter recipes by name in real-time as the user types in the search field, with debouncing (~300ms delay after typing stops)
-   **FR-019**: Application MUST filter recipes by ingredient in real-time as the user types in the search field, with debouncing (~300ms delay after typing stops)
-   **FR-020**: Application MUST filter recipes to show only those with preparation time less than or equal to the selected maximum when a user selects a max preparation time
-   **FR-021**: Application MUST filter recipes to show only those with cook time less than or equal to the selected maximum when a user selects a max cook time
-   **FR-022**: Application MUST apply all active filters simultaneously (search term, max prep time, max cook time)
-   **FR-023**: Application MUST update the displayed recipe list immediately when any filter value changes

**Responsive Design & Interactivity**

-   **FR-024**: Application MUST provide responsive layouts that adapt to different screen sizes (desktop, tablet, mobile)
-   **FR-025**: Application MUST display hover states for all interactive elements when a user hovers over them
-   **FR-026**: Application MUST display focus states for all interactive elements when they receive keyboard focus
-   **FR-027**: Application MUST support keyboard navigation for all interactive elements

**Content & Data Handling**

-   **FR-028**: Application MUST handle cases where recipe images are missing or fail to load by displaying a placeholder or fallback image
-   **FR-029**: Application MUST display an appropriate message when filter/search criteria result in zero matching recipes while persisting all current filter selections
-   **FR-030**: Application MUST handle cases where fewer than 3 related recipes are available by displaying available recipes without leaving empty spaces
-   **FR-031**: Application MUST gracefully handle incomplete recipe data (missing optional fields like description)

### Key Entities _(include if feature involves data)_

-   **Recipe**: Represents a cooking recipe with attributes including picture (image), title (text), description (text), servings (number), preparation time (duration in minutes), cook time (duration in minutes), instructions (free-form text), ingredients (list of text items for search purposes), and related recipes (references to other recipe entities)
-   **Page**: Represents different sections of the application (Home, About, Recipes Index, Recipe Detail) with navigation relationships between them
-   **Navigation**: Represents the navigation structure including links, logo, and Browse Recipes button, consistent across all pages
-   **Footer**: Represents footer content including informational text and social media links, consistent across all pages

## Success Criteria _(mandatory)_

### Measurable Outcomes

-   **SC-001**: Users can navigate from the home page to viewing a recipe detail page in under 30 seconds
-   **SC-002**: Users can find a specific recipe using search functionality within 15 seconds of entering a search term
-   **SC-003**: Filter controls reduce the recipe list to relevant results in under 1 second after selection
-   **SC-004**: Application layout adapts seamlessly to screen sizes from 320px (mobile) to 1920px (desktop) wide
-   **SC-005**: 95% of users successfully complete their primary task (finding and viewing a recipe) on their first attempt
-   **SC-006**: All interactive elements display visible hover and focus states within 100 milliseconds of user interaction
-   **SC-007**: Search and filter operations return relevant results with 100% accuracy based on selected criteria
-   **SC-008**: Recipe detail pages load and display complete information in under 2 seconds on standard broadband connections
-   **SC-009**: Related recipes section displays appropriate content (1-3 recipes) on 100% of detail pages

## Clarifications

### Session 2025-12-28

-   Q: When a user searches for recipes, should the search behavior operate in real-time as they type or only when they explicitly submit/trigger the search? → A: Real-time (as-you-type) with debouncing - filters update automatically after user stops typing for ~300ms
-   Q: The recipe detail page needs to include complete cooking instructions. Should instructions be displayed as structured steps or free-form text? → A: Free-form paragraph - instructions as continuous descriptive text
-   Q: What should happen to filter dropdown selections when a user performs a search that returns zero results? → A: Persist all filters - keep current selections so users can modify them
-   Q: Should the recipe cards on the index page display the full ingredient list or just a count/summary of ingredients? → A: Count only - show number of ingredients (e.g., "12 ingredients")
-   Q: How should the "Related Recipes" be determined for each recipe detail page? → A: Random selection - randomly chosen from all available recipes

## Assumptions

-   Recipe data (images, text content, timing information) is available from a data source and can be accessed by the application
-   Recipe images are provided in web-optimized formats with reasonable file sizes
-   The recipe collection contains sufficient variety to support meaningful filtering and related recipe suggestions
-   Social media profile URLs are predetermined and do not require configuration by end users
-   Standard web accessibility practices (WCAG 2.1 Level AA) should be followed for focus states and keyboard navigation
-   Search functionality performs case-insensitive matching on recipe names and ingredient lists
-   Filter dropdown options for prep time and cook time use standardized time increments (e.g., 15, 30, 45, 60 minutes)
-   Related recipes are randomly selected from all available recipes (excluding the currently displayed recipe)
-   The application is a client-facing web application accessible via modern web browsers (Chrome, Firefox, Safari, Edge - latest 2 versions)
-   Recipe data persistence and management is handled outside the scope of this feature (assumes read-only access to recipe data)

## Technical Standards _(mandatory for future projects)_

### Modern SCSS Architecture (2026 Standards)

This project implements a modern, maintainable SCSS architecture that MUST be followed in all future projects for consistency and best practices.

#### Structure Requirements

**SCSS-001**: Project MUST organize styles using a flat folder structure with three main directories:

-   `global/` - Global styles including colors, typography, layout, forms, and base styles
-   `components/` - Component-specific styles using BEM methodology
-   `util/` - SCSS utilities including functions and mixins

**SCSS-002**: Project MUST NOT use numbered folder prefixes (e.g., `0-settings`, `1-tools`, `2-generic`). Folder names MUST be semantic and descriptive.

**SCSS-003**: Each directory MUST contain an `_index.scss` file that uses `@forward` to export all module files.

**SCSS-004**: Main entry point (`app.scss`) MUST use modern `@use` syntax (NOT deprecated `@import`) and MUST be concise:

```scss
@use "util";
@use "global";
@use "components";
```

#### CSS Variables & Custom Properties

**SCSS-005**: Project MUST use CSS custom properties (CSS variables) defined in `:root` selector, NOT SCSS variables, for all design tokens including:

-   Colors (e.g., `--c-primary-500`, `--color-bg-primary`)
-   Spacing (e.g., `--spacing-200`, `--spacing-400`)
-   Typography (e.g., `--fs-16`, `--fw-bold`, `--lh-normal`)
-   Border radius (e.g., `--br-10`, `--br-round`)
-   Shadows (e.g., `--shadow-md`, `--shadow-lg`)
-   Transitions (e.g., `--transition-fast`, `--transition-base`)

**SCSS-006**: Color definitions MUST use OKLCH color space for perceptually uniform colors:

```scss
--c-primary-500: oklch(70% 0.18 30);
```

**SCSS-007**: Semantic color variables MUST use `light-dark()` function for automatic theme support:

```scss
--color-bg-primary: light-dark(var(--c-white), var(--c-neutral-950));
--color-text-primary: light-dark(var(--c-neutral-900), var(--c-neutral-100));
```

**SCSS-008**: Typography MUST use fluid sizing with `clamp()` for responsive text:

```scss
--fs-48: clamp(#{rem(32)}, 2rem + 2vw, #{rem(48)});
```

#### CSS Layers for Cascade Control

**SCSS-009**: Project MUST use CSS `@layer` to organize styles with explicit cascade ordering:

-   `@layer reset` - CSS reset (lowest priority)
-   `@layer global` - Global base styles
-   `@layer typography` - Typography styles
-   `@layer layout` - Layout utilities
-   `@layer forms` - Form element styles
-   `@layer components` - Component styles (highest priority)

**SCSS-010**: All global styles MUST be wrapped in appropriate `@layer` declarations to ensure predictable cascade without specificity wars.

#### Component Architecture

**SCSS-011**: Components MUST follow BEM (Block Element Modifier) naming methodology:

-   Block: `.recipe-card`
-   Element: `.recipe-card__title`
-   Modifier: `.recipe-card--featured`

**SCSS-012**: Component styles MUST be wrapped in `@layer components` declaration.

**SCSS-013**: Components MUST use CSS custom properties for all colors, spacing, and other design tokens (NOT hard-coded values).

**SCSS-014**: Components MUST NOT use `@extend` for layout utilities (causes issues with layer ordering). Instead, directly apply the CSS properties.

#### Layout Patterns

**SCSS-015**: Project MUST implement sticky footer pattern using flexbox:

```scss
body {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

main {
    flex: 1 0 auto;
}

footer {
    flex-shrink: 0;
}
```

**SCSS-016**: Container/wrapper classes MUST use CSS custom properties for max-width and padding:

```scss
.wrapper {
    width: 100%;
    max-width: var(--wrapper-size);
    margin-inline: auto;
    padding-inline: var(--wrapper-padding);
}
```

#### Responsive Design

**SCSS-017**: Breakpoint mixins MUST use modern `width` media query syntax:

```scss
@mixin breakpoint($size) {
    @media (width >= map.get($breakpoints, $size)) {
        @content;
    }
}
```

**SCSS-018**: Breakpoint names MUST use short, clear abbreviations:

-   `sm`: 640px (small)
-   `md`: 768px (medium)
-   `lg`: 1024px (large)
-   `xl`: 1280px (extra large)
-   `xxl`: 1536px (extra extra large)

**SCSS-019**: Breakpoint values MUST be defined in `em` units using utility function for better accessibility.

#### Utility Functions

**SCSS-020**: Project MUST provide `rem()` and `em()` utility functions for unit conversion:

```scss
@function rem($pixels) {
    @return math.div($pixels, 16) * 1rem;
}
```

**SCSS-021**: All pixel-based values in SCSS SHOULD be converted to `rem` or `em` units for better scalability.

#### Modern CSS Features

**SCSS-022**: Project SHOULD use relative color syntax for opacity variations:

```scss
// Transparent background with alpha
background-color: oklch(from var(--c-primary-600) l c h / 0.1);
```

**SCSS-023**: Project SHOULD use `backdrop-filter` for glassmorphism effects on sticky navigation:

```scss
backdrop-filter: blur(8px);
```

**SCSS-024**: Interactive elements SHOULD use CSS transitions with custom property timing:

```scss
transition: all var(--transition-fast);
```

#### File Organization

**SCSS-025**: Global folder MUST contain at minimum:

-   `_colors.scss` - Color system with CSS variables
-   `_boilerplate.scss` - Reset and base styles with layers
-   `_typography.scss` - Font definitions and text styles
-   `_layout.scss` - Layout utilities and sticky footer
-   `_forms.scss` - Form element styles
-   `_index.scss` - Exports using `@forward`

**SCSS-026**: Util folder MUST contain:

-   `_functions.scss` - SCSS functions (rem, em, etc.)
-   `_mixins.scss` - SCSS mixins (breakpoints, etc.)
-   `_index.scss` - Exports using `@forward`

**SCSS-027**: Components folder structure:

-   One file per component using BEM naming
-   `_index.scss` to export all components
-   Components MUST be self-contained with all related styles

#### Browser Support & Compatibility

**SCSS-028**: Architecture MUST support modern browsers (latest 2 versions of Chrome, Firefox, Safari, Edge).

**SCSS-029**: CSS features used MUST have minimum 80% global browser support OR include appropriate fallbacks.

**SCSS-030**: Project SHOULD use `color-scheme` CSS property for automatic OS-level theme detection:

```scss
@media (prefers-color-scheme: light) {
    color-scheme: light;
}

@media (prefers-color-scheme: dark) {
    color-scheme: dark;
}
```

#### Development Experience

**SCSS-031**: CSS custom properties MUST be inspectable in browser dev tools (this is the primary reason for using CSS variables over SCSS variables).

**SCSS-032**: Variable naming MUST be semantic and follow these patterns:

-   Primitive values: `--c-primary-500` (color), `--spacing-300` (spacing)
-   Semantic tokens: `--color-bg-primary` (background), `--color-text-primary` (text)

**SCSS-033**: Build output SHOULD be optimized and smaller than previous ITCSS implementations (target: <20kB for typical application).

#### Migration from Legacy SCSS

When converting existing projects from ITCSS or other legacy structures:

**SCSS-034**: Replace SCSS variables with CSS custom properties in `:root`.

**SCSS-035**: Wrap styles in appropriate `@layer` declarations for cascade control.

**SCSS-036**: Convert hard-coded colors to OKLCH color space.

**SCSS-037**: Implement `light-dark()` for semantic color variables.

**SCSS-038**: Replace multiple media queries with fluid typography using `clamp()`.

**SCSS-039**: Update `@import` statements to modern `@use` and `@forward`.

**SCSS-040**: Remove numbered folder prefixes and restructure into flat architecture.

#### Benefits of This Architecture

-   **Maintainability**: Clear separation of concerns with semantic folder names
-   **Debuggability**: CSS variables inspectable in browser dev tools
-   **Theme Support**: Built-in light/dark theme with `light-dark()` function
-   **Performance**: Smaller CSS output (~11% reduction vs ITCSS)
-   **Modern Standards**: Uses latest CSS features (layers, OKLCH, relative colors)
-   **Cascade Control**: Explicit layer ordering eliminates specificity issues
-   **Future-Proof**: Industry-standard patterns used by modern frameworks
-   **Developer Experience**: Cleaner code, easier to navigate, faster development

#### Reference Implementation

See project files for complete implementation:

-   `resources/scss/global/` - Global styles with CSS layers
-   `resources/scss/components/` - BEM components
-   `resources/scss/util/` - SCSS utilities
-   `resources/scss/app.scss` - Entry point
-   `SCSS_RESTRUCTURE.md` - Complete migration guide
-   `SCSS_BEFORE_AFTER.md` - Visual comparison with examples

This architecture MUST be used as the foundation for all future projects to ensure consistency, maintainability, and adherence to 2026 CSS best practices.
