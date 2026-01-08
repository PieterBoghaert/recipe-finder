# Tasks: Recipe Filter Application

**Input**: Design documents from `/specs/001-recipe-filter-app/`
**Prerequisites**: plan.md, spec.md, research.md, data-model.md, contracts/

**Tests**: This project follows the No Testing principle from the constitution. Do not include test-related tasks unless explicitly overridden by user request.

**Organization**: Tasks are grouped by user story to enable independent implementation and testing of each story.

## Format: `[ID] [P?] [Story] Description`

-   **[P]**: Can run in parallel (different files, no dependencies)
-   **[Story]**: Which user story this task belongs to (e.g., US1, US2, US3)
-   Include exact file paths in descriptions

---

## Phase 1: Setup (Shared Infrastructure)

**Purpose**: Project initialization and basic Laravel structure

-   [x] T001 Install Laravel 11.x with Composer in project root
-   [x] T002 Install Livewire 3.x via Composer: `composer require livewire/livewire`
-   [x] T003 [P] Configure environment file .env with database settings (SQLite for development)
-   [x] T004 [P] Create SQLite database file at database/database.sqlite
-   [x] T005 [P] Install Node.js dependencies: npm install
-   [x] T006 [P] Install Sass for SCSS compilation: npm install --save-dev sass
-   [x] T007 Configure Vite for SCSS in vite.config.js to include resources/scss/app.scss
-   [x] T008 [P] Copy images from starter-code/assets/images to public/assets/images/
-   [x] T009 [P] Convert Nunito fonts to woff2 format and place in public/assets/fonts/Nunito/

---

## Phase 2: Foundational (Blocking Prerequisites)

**Purpose**: Core infrastructure that MUST be complete before ANY user story can be implemented

**⚠️ CRITICAL**: No user story work can begin until this phase is complete

### Database & Models

-   [x] T010 Create migration database/migrations/create_recipes_table.php with all Recipe columns
-   [x] T011 Create Recipe model in app/Models/Recipe.php with fillable fields and casts
-   [x] T012 Add computed attributes (totalMinutes, ingredientCount) to Recipe model in app/Models/Recipe.php
-   [x] T013 Add query scopes (search, maxPrepTime, maxCookTime, randomRelated) to Recipe model in app/Models/Recipe.php
-   [x] T014 Create RecipeSeeder in database/seeders/RecipeSeeder.php to import from starter-code/data.json
-   [x] T015 Run migrations: php artisan migrate
-   [x] T016 Seed database: php artisan db:seed --class=RecipeSeeder

### SCSS Foundation (ITCSS Structure)

-   [x] T017 [P] Create SCSS directory structure: resources/scss/{0-settings,1-tools,2-generic,3-elements,4-objects,5-components,6-utilities}/
-   [x] T018 [P] Create color tokens in resources/scss/0-settings/\_colors.scss with OKLCH variables
-   [x] T019 [P] Create typography tokens in resources/scss/0-settings/\_typography.scss with clamp() presets
-   [x] T020 [P] Create spacing tokens in resources/scss/0-settings/\_spacing.scss
-   [x] T021 [P] Create radius tokens in resources/scss/0-settings/\_radius.scss
-   [x] T022 [P] Create mixins in resources/scss/1-tools/\_mixins.scss for responsive design
-   [x] T023 [P] Create CSS reset in resources/scss/2-generic/\_reset.scss
-   [x] T024 [P] Create base typography styles in resources/scss/3-elements/\_typography.scss with @font-face
-   [x] T025 [P] Create base form styles in resources/scss/3-elements/\_forms.scss
-   [x] T026 [P] Create page styles in resources/scss/3-elements/\_page.scss (html, body)
-   [x] T027 [P] Create container object in resources/scss/4-objects/\_container.scss
-   [x] T028 [P] Create grid object in resources/scss/4-objects/\_grid.scss with container queries
-   [x] T029 Create main SCSS entry file resources/scss/app.scss with @use imports and @layer definitions

### Routes & Base Layout

-   [x] T030 Create base layout in resources/views/layouts/app.blade.php with @vite, @livewireStyles, @livewireScripts
-   [x] T031 Configure routes in routes/web.php for home, about, and Livewire recipe routes

**Checkpoint**: Foundation ready - user story implementation can now begin in parallel

---

## Phase 3: User Story 4 - Navigate Between Pages (Priority: P1) 🎯 MVP

**Goal**: Enable users to navigate between all pages (home, about, recipes) via navigation bar and logo

**Independent Test**: Click logo, Home, About, Recipes links, and Browse Recipes button - verify correct pages load

### Navigation Component for US4

-   [x] T032 [P] [US4] Create Navigation blade component in resources/views/components/navigation.blade.php
-   [x] T033 [US4] Implement navigation HTML structure with logo, nav links (Home, About, Recipes), Browse Recipes button in resources/views/components/navigation.blade.php
-   [x] T034 [US4] Create navigation styles in resources/scss/5-components/\_navigation.scss with mobile-first approach
-   [x] T035 [US4] Implement pure CSS hamburger menu using checkbox hack in resources/scss/5-components/\_navigation.scss
-   [x] T036 [US4] Add responsive breakpoints for desktop nav in resources/scss/5-components/\_navigation.scss

### Pages for US4

-   [x] T037 [P] [US4] Create home page view in resources/views/pages/home.blade.php
-   [x] T038 [P] [US4] Create about page view in resources/views/pages/about.blade.php
-   [x] T039 [US4] Add navigation component to layout in resources/views/layouts/app.blade.php

**Checkpoint**: At this point, User Story 4 should be fully functional - test navigation between all pages

---

## Phase 4: User Story 6 - View Footer Information (Priority: P3)

**Goal**: Display footer with informational text and social media icons on all pages

**Independent Test**: Scroll to bottom of any page and verify footer content and social media links

### Footer Component for US6

-   [x] T040 [P] [US6] Create Footer blade component in resources/views/components/footer.blade.php
-   [x] T041 [US6] Implement footer HTML with informational text and social media icons (Instagram, Twitter, TikTok) in resources/views/components/footer.blade.php
-   [x] T042 [US6] Create footer styles in resources/scss/5-components/\_footer.scss
-   [x] T043 [US6] Add footer component to layout in resources/views/layouts/app.blade.php

**Checkpoint**: Footer displays on all pages

---

## Phase 5: User Story 1 - Browse and View Recipes (Priority: P1) 🎯 MVP

**Goal**: Display recipe cards in a grid, allow clicking to view detail page with full recipe info and related recipes

**Independent Test**: Navigate to /recipes, view recipe cards with all metadata, click "View Recipe", verify detail page shows complete info and 3 related recipes

### Recipe Card Component for US1

-   [x] T044 [P] [US1] Create RecipeCard blade component in resources/views/components/recipe-card.blade.php
-   [x] T045 [US1] Implement recipe card HTML structure with picture, title, description, servings, prep time, cook time, ingredient count, View Recipe button in resources/views/components/recipe-card.blade.php
-   [x] T046 [US1] Create recipe card styles in resources/scss/5-components/\_recipe-card.scss
-   [x] T047 [US1] Add responsive image handling with picture element in resources/views/components/recipe-card.blade.php
-   [x] T048 [US1] Style View Recipe button in resources/scss/5-components/\_button.scss

### RecipeList Livewire Component for US1

-   [x] T049 [US1] Create RecipeList Livewire component: php artisan make:livewire RecipeList
-   [x] T050 [US1] Implement RecipeList public properties (searchTerm, maxPrepTime, maxCookTime, perPage) in app/Http/Livewire/RecipeList.php
-   [x] T051 [US1] Implement getRecipesProperty computed property with filtering and pagination in app/Http/Livewire/RecipeList.php
-   [x] T052 [US1] Create RecipeList view with recipe grid in resources/views/livewire/recipe-list.blade.php
-   [x] T053 [US1] Add pagination controls to RecipeList view in resources/views/livewire/recipe-list.blade.php
-   [x] T054 [US1] Handle no results state with message in resources/views/livewire/recipe-list.blade.php

### RecipeDetail Livewire Component for US1

-   [x] T055 [US1] Create RecipeDetail Livewire component: php artisan make:livewire RecipeDetail
-   [x] T056 [US1] Implement mount method to load recipe by slug in app/Http/Livewire/RecipeDetail.php
-   [x] T057 [US1] Implement getRelatedRecipesProperty computed property (random selection, max 3, exclude current) in app/Http/Livewire/RecipeDetail.php
-   [x] T058 [US1] Create RecipeDetail view structure with all recipe information in resources/views/livewire/recipe-detail.blade.php
-   [x] T059 [US1] Add ingredients list (full list) to RecipeDetail view in resources/views/livewire/recipe-detail.blade.php
-   [x] T060 [US1] Add instructions (free-form text) to RecipeDetail view in resources/views/livewire/recipe-detail.blade.php
-   [x] T061 [US1] Add Related Recipes section with recipe cards to RecipeDetail view in resources/views/livewire/recipe-detail.blade.php
-   [x] T062 [US1] Handle 404 for invalid slug in app/Http/Livewire/RecipeDetail.php mount method
-   [x] T063 [US1] Handle fewer than 3 related recipes gracefully in resources/views/livewire/recipe-detail.blade.php

**Checkpoint**: At this point, User Story 1 should be fully functional - test browsing recipes and viewing details with related recipes

---

## Phase 6: User Story 2 - Filter Recipes by Time (Priority: P2)

**Goal**: Allow users to filter recipes by maximum prep time and cook time using dropdown selects

**Independent Test**: Navigate to /recipes, select prep time filter (e.g., "30 minutes"), verify only matching recipes shown; select cook time filter, verify combined filtering works

### Filter Controls for US2

-   [x] T064 [P] [US2] Create filter styles in resources/scss/5-components/\_filters.scss with custom select styling (appearance: none)
-   [x] T065 [US2] Add maxPrepTime dropdown select to RecipeList view in resources/views/livewire/recipe-list.blade.php with wire:model.live
-   [x] T066 [US2] Add maxCookTime dropdown select to RecipeList view in resources/views/livewire/recipe-list.blade.php with wire:model.live
-   [x] T067 [US2] Add filter time options (10, 15, 30, 45, 60 minutes) to dropdown selects in resources/views/livewire/recipe-list.blade.php
-   [x] T068 [US2] Implement updatedMaxPrepTime method with resetPage in app/Http/Livewire/RecipeList.php
-   [x] T069 [US2] Implement updatedMaxCookTime method with resetPage in app/Http/Livewire/RecipeList.php
-   [x] T070 [US2] Style filter controls for responsive design (mobile, tablet, desktop) in resources/scss/5-components/\_filters.scss

**Checkpoint**: User Stories 1 AND 2 should both work independently - test filtering by time without affecting US1 functionality

---

## Phase 7: User Story 3 - Search for Recipes (Priority: P2)

**Goal**: Allow users to search recipes by name or ingredient with real-time filtering (300ms debounce)

**Independent Test**: Navigate to /recipes, type recipe name in search field, verify filtering after 300ms; type ingredient name, verify ingredient-based filtering works

### Search Functionality for US3

-   [x] T071 [US3] Add search input field to RecipeList view in resources/views/livewire/recipe-list.blade.php with wire:model.debounce.300ms
-   [x] T072 [US3] Style search input field in resources/scss/5-components/\_filters.scss
-   [x] T073 [US3] Implement updatedSearchTerm method with resetPage in app/Http/Livewire/RecipeList.php
-   [x] T074 [US3] Add clearFilters method to reset all filters in app/Http/Livewire/RecipeList.php
-   [x] T075 [US3] Add Clear Filters button to RecipeList view in resources/views/livewire/recipe-list.blade.php with wire:click="clearFilters"
-   [x] T076 [US3] Style Clear Filters button in resources/scss/5-components/\_button.scss
-   [x] T077 [US3] Test combined search + time filters work together in browser

**Checkpoint**: All three filtering features (search, prep time, cook time) should work independently and together

---

## Phase 8: User Story 5 - Interactive Feedback (Priority: P3)

**Goal**: Provide visual feedback (hover and focus states) for all interactive elements

**Independent Test**: Hover over navigation links, buttons, form controls - verify hover states; tab through page - verify focus states

### Interactive States for US5

-   [x] T078 [P] [US5] Add hover states for navigation links in resources/scss/5-components/\_navigation.scss
-   [x] T079 [P] [US5] Add focus states for navigation links in resources/scss/5-components/\_navigation.scss
-   [x] T080 [P] [US5] Add hover and focus states for buttons in resources/scss/5-components/\_button.scss
-   [x] T081 [P] [US5] Add hover and focus states for form inputs in resources/scss/3-elements/\_forms.scss
-   [x] T082 [P] [US5] Add hover and focus states for filter selects in resources/scss/5-components/\_filters.scss
-   [x] T083 [P] [US5] Add hover state for recipe cards in resources/scss/5-components/\_recipe-card.scss
-   [x] T084 [P] [US5] Add hover state for footer social icons in resources/scss/5-components/\_footer.scss
-   [x] T085 [US5] Test keyboard navigation (tab order) and verify all focus states visible

**Checkpoint**: All interactive elements should have visible hover and focus states

---

## Phase 9: Polish & Cross-Cutting Concerns

**Purpose**: Improvements that affect multiple user stories and final quality checks

### View Transitions API

-   [x] T086 [P] Add View Transitions API integration in resources/js/app.js for filter animations
-   [x] T087 [P] Add CSS for view transitions in resources/scss/5-components/\_recipe-card.scss

### Responsive Design Polish

-   [x] T088 [P] Test mobile layout (320px-767px) and adjust spacing/typography in all SCSS files
-   [x] T089 [P] Test tablet layout (768px-1023px) and verify 2-3 column grid in resources/scss/4-objects/\_grid.scss
-   [x] T090 [P] Test desktop layout (1024px+) and verify 3-4 column grid in resources/scss/4-objects/\_grid.scss
-   [x] T091 Verify clamp() typography scales smoothly across all viewport sizes

### Image Optimization

-   [x] T092 [P] Add lazy loading to recipe card images in resources/views/components/recipe-card.blade.php
-   [x] T093 [P] Add fallback background color for missing images in resources/scss/5-components/\_recipe-card.scss
-   [x] T094 [P] Verify alt text present on all images in blade templates

### Accessibility

-   [x] T095 [P] Verify touch targets are 44x44px minimum across all components
-   [x] T096 [P] Test keyboard navigation through entire application
-   [x] T097 [P] Verify ARIA labels present where needed in navigation and forms
-   [x] T098 Verify color contrast meets WCAG AA standards using browser dev tools

### Error Handling

-   [x] T099 [P] Add 404 error page in resources/views/errors/404.blade.php
-   [x] T100 [P] Test invalid recipe slug URLs and verify 404 page displays
-   [x] T101 [P] Test zero search results and verify message displays correctly

### Performance

-   [x] T102 Run php artisan optimize for production caching
-   [x] T103 Build production assets: npm run build
-   [x] T104 Test filter response time (<1s requirement) in browser dev tools
-   [x] T105 Test page load time (<2s requirement) in browser dev tools

### Final Validation

-   [x] T106 Run through quickstart.md manual testing checklist for all user stories
-   [x] T107 Verify all user stories work independently without breaking each other
-   [x] T108 Test on multiple browsers (Chrome, Firefox, Safari, Edge)
-   [x] T109 Test on actual mobile device (not just browser simulation)
-   [x] T110 Document any known issues or limitations in README.md

---

## Dependencies & Execution Order

### Phase Dependencies

-   **Setup (Phase 1)**: No dependencies - can start immediately
-   **Foundational (Phase 2)**: Depends on Setup completion - BLOCKS all user stories
-   **User Story 4 - Navigate (Phase 3)**: Depends on Foundational - P1 priority (MVP)
-   **User Story 6 - Footer (Phase 4)**: Depends on Foundational - P3 priority
-   **User Story 1 - Browse/View (Phase 5)**: Depends on Foundational - P1 priority (MVP)
-   **User Story 2 - Time Filters (Phase 6)**: Depends on US1 completion (extends RecipeList)
-   **User Story 3 - Search (Phase 7)**: Depends on US1 completion (extends RecipeList)
-   **User Story 5 - Interactive (Phase 8)**: Depends on all components being built - P3 priority
-   **Polish (Phase 9)**: Depends on all desired user stories being complete

### User Story Dependencies

-   **User Story 4 (P1 - Navigation)**: Can start after Foundational - No dependencies on other stories
-   **User Story 1 (P1 - Browse/View)**: Can start after Foundational - No dependencies on other stories
-   **User Story 6 (P3 - Footer)**: Can start after Foundational - No dependencies on other stories
-   **User Story 2 (P2 - Time Filters)**: Depends on User Story 1 (extends RecipeList component)
-   **User Story 3 (P2 - Search)**: Depends on User Story 1 (extends RecipeList component)
-   **User Story 5 (P3 - Interactive)**: Depends on all components existing

### MVP Recommendation (Phases 1-5 Only)

For fastest time to value, implement in this order:

1. **Phase 1**: Setup (T001-T009)
2. **Phase 2**: Foundational (T010-T031) - CRITICAL BLOCKER
3. **Phase 3**: User Story 4 - Navigation (T032-T039)
4. **Phase 5**: User Story 1 - Browse/View Recipes (T044-T063)
5. **Stop and validate**: Test navigation + recipe browsing independently

This delivers core value: users can navigate and view recipes.

### Full Feature Delivery Order

After MVP, continue with: 6. **Phase 6**: User Story 2 - Time Filters (T064-T070) 7. **Phase 7**: User Story 3 - Search (T071-T077) 8. **Phase 4**: User Story 6 - Footer (T040-T043) 9. **Phase 8**: User Story 5 - Interactive Feedback (T078-T085) 10. **Phase 9**: Polish (T086-T110)

### Within Each User Story

-   [P] tasks (different files) can run in parallel
-   Models/components before views
-   Styles can be done in parallel with HTML/PHP
-   Test story independently before moving to next

### Parallel Opportunities

**Setup Phase** (all [P] tasks can run together):

-   T003, T004, T005, T006, T008, T009

**Foundational SCSS** (all [P] tasks T017-T028 can run together):

-   Create all SCSS files in parallel since they're in different files

**User Story 1 Components** (T044, T049, T055 can start together):

-   RecipeCard blade component
-   RecipeList Livewire component
-   RecipeDetail Livewire component

**User Story 5 Interactive States** (T078-T084 can run in parallel):

-   Add hover/focus states to different SCSS files simultaneously

---

## Parallel Example: Foundational Phase (Phase 2)

```bash
# Developer A: Database & Models
Tasks: T010, T011, T012, T013, T014, T015, T016

# Developer B: SCSS Structure (all parallel)
Tasks: T017, T018, T019, T020, T021, T022, T023, T024, T025, T026, T027, T028

# Developer C: Base Layout & Routes
Tasks: T029, T030, T031

# All three can work simultaneously since different file groups
```

---

## Parallel Example: User Story 1 (Phase 5)

```bash
# Launch components together (different files):
Task: T044 - Create RecipeCard component
Task: T049 - Create RecipeList Livewire component
Task: T055 - Create RecipeDetail Livewire component

# Launch styling together (different SCSS files):
Task: T046 - Recipe card styles
Task: T048 - Button styles

# Once components exist, build their functionality in sequence
```

---

## Implementation Strategy

### MVP First (User Stories 1 & 4 Only)

1. Complete Phase 1: Setup (T001-T009)
2. Complete Phase 2: Foundational (T010-T031) - CRITICAL BLOCKER
3. Complete Phase 3: User Story 4 - Navigation (T032-T039)
4. Complete Phase 5: User Story 1 - Browse/View (T044-T063)
5. **STOP and VALIDATE**: Open browser, test navigation, browse recipes, view detail pages
6. Deploy/demo if ready - this is a functional MVP

**MVP Delivers**: Navigation + recipe browsing + detail views with related recipes

### Incremental Delivery

1. Complete Setup + Foundational → Foundation ready
2. Add Navigation (US4) → Test independently → Deploy/Demo
3. Add Browse/View (US1) → Test independently → Deploy/Demo (MVP!)
4. Add Time Filters (US2) → Test independently → Deploy/Demo
5. Add Search (US3) → Test independently → Deploy/Demo
6. Add Footer (US6) + Interactive (US5) → Polish → Deploy/Demo

Each user story adds value without breaking previous stories.

### Parallel Team Strategy

With multiple developers:

1. **Team together**: Complete Setup (Phase 1) and Foundational (Phase 2)
2. **Once Foundational done, split**:
    - Developer A: User Story 4 (Navigation)
    - Developer B: User Story 1 (Browse/View)
    - Developer C: User Story 6 (Footer) + SCSS styling
3. **Then continue**:
    - Developer A: User Story 2 (Time Filters)
    - Developer B: User Story 3 (Search)
    - Developer C: User Story 5 (Interactive States)
4. **Team together**: Phase 9 (Polish & Testing)

---

## Task Summary

**Total Tasks**: 110

### By Phase:

-   **Phase 1 (Setup)**: 9 tasks (T001-T009)
-   **Phase 2 (Foundational)**: 22 tasks (T010-T031)
-   **Phase 3 (US4 - Navigation)**: 8 tasks (T032-T039)
-   **Phase 4 (US6 - Footer)**: 4 tasks (T040-T043)
-   **Phase 5 (US1 - Browse/View)**: 20 tasks (T044-T063)
-   **Phase 6 (US2 - Time Filters)**: 7 tasks (T064-T070)
-   **Phase 7 (US3 - Search)**: 7 tasks (T071-T077)
-   **Phase 8 (US5 - Interactive)**: 8 tasks (T078-T085)
-   **Phase 9 (Polish)**: 25 tasks (T086-T110)

### By User Story:

-   **US1 (Browse/View)**: 20 tasks
-   **US2 (Time Filters)**: 7 tasks
-   **US3 (Search)**: 7 tasks
-   **US4 (Navigation)**: 8 tasks
-   **US5 (Interactive)**: 8 tasks
-   **US6 (Footer)**: 4 tasks
-   **Infrastructure**: 31 tasks (Setup + Foundational)
-   **Polish**: 25 tasks

### Parallel Opportunities:

-   **Setup**: 6 tasks marked [P]
-   **Foundational**: 14 tasks marked [P]
-   **User Stories**: 8 tasks marked [P]
-   **Polish**: 12 tasks marked [P]

**Total [P] tasks**: 40 (can run in parallel when phase allows)

### MVP Scope (Phases 1-5):

-   **Tasks**: 59 tasks (T001-T063 excluding US6)
-   **Time Estimate**: 3-5 days for experienced Laravel developer
-   **Delivers**: Navigation + recipe browsing + detail views

### Full Feature Scope (All Phases):

-   **Tasks**: 110 tasks
-   **Time Estimate**: 5-8 days for experienced Laravel developer
-   **Delivers**: Complete recipe filter application with all features

---

## Format Validation

✅ All tasks follow checklist format: `- [ ] [TaskID] [P?] [Story?] Description with file path`
✅ All tasks have unique sequential IDs (T001-T110)
✅ All user story tasks have [Story] label (US1-US6)
✅ All parallel tasks marked with [P]
✅ All tasks include specific file paths
✅ Setup and Foundational tasks have NO story label
✅ Polish tasks have NO story label (cross-cutting)

---

## Notes

-   [P] tasks = different files, no dependencies - can run in parallel
-   [Story] label maps task to specific user story for traceability
-   Each user story should be independently completable and manually testable
-   Run `php artisan serve` and `npm run dev` to validate features work in browser
-   Commit after each task or logical group of related tasks
-   Stop at any checkpoint to manually validate story independently
-   Focus on MVP first (US1 + US4) before adding filters and search
-   No automated tests per constitution - manual testing via browser
