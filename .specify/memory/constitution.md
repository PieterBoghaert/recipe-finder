<!--
SYNC IMPACT REPORT
==================
Version Change: INITIAL → 1.0.0
Principles Added:
  - I. Clean Code
  - II. Simple UX
  - III. Responsive Design
  - IV. Minimal Dependencies
  - V. No Testing
Technology Stack:
  - Laravel Livewire (MUST use)
  - Custom CSS with layers and Open Props library (MUST use)
Templates Status:
  - ✅ plan-template.md: Constitution Check section aligns with principles
  - ✅ spec-template.md: User scenarios and requirements support UX-first approach
  - ✅ tasks-template.md: Phases align with no-testing principle
Follow-up: None
-->

# Recipe Finder Constitution

## Core Principles

### I. Clean Code

Code MUST be readable, maintainable, and follow consistent conventions:

- Use meaningful variable and function names that express intent
- Keep functions and methods focused on a single responsibility
- Prefer explicit over implicit - clarity over cleverness
- Follow PSR-12 coding standards for PHP/Laravel
- Use comments sparingly - code should be self-documenting
- Organize files and folders logically by feature or domain

**Rationale**: Clean code reduces cognitive load, accelerates onboarding, and minimizes bugs through clarity. In a small team or solo project, future maintainability depends on present discipline.

### II. Simple UX

User experience MUST prioritize simplicity and intuitiveness:

- Every feature serves a clear user need - no feature creep
- Navigation must be obvious and require minimal clicks
- Forms and interactions follow convention over innovation
- Provide immediate feedback for all user actions
- Error messages must be helpful and guide users to solutions
- Mobile-first design ensures usability on smallest screens

**Rationale**: Users abandon complex interfaces. Simple UX reduces support burden and increases engagement. The recipe finder must be accessible to all skill levels without training.

### III. Responsive Design

All interfaces MUST work seamlessly across device sizes:

- Mobile-first CSS approach using modern layout techniques (flexbox, grid)
- Fluid typography and spacing that scales naturally
- Touch targets minimum 44x44px for mobile usability
- Images and media must be responsive and optimized
- Test on real devices, not just browser simulation
- No horizontal scrolling except for intentional carousels

**Rationale**: Users access recipe content from various contexts - kitchen tablets, mobile phones while shopping, desktop while planning. Responsive design is non-negotiable for modern web applications.

### IV. Minimal Dependencies

External dependencies MUST be justified and minimized:

- Use native browser features before adding libraries (e.g., Fetch API, CSS custom properties)
- Every dependency must solve a significant problem or provide substantial time savings
- Evaluate bundle size impact before adoption
- Prefer Laravel's built-in features over third-party packages
- Document why each dependency exists

**Rationale**: Dependencies introduce security risks, increase bundle size, and create maintenance burden. Open Props provides design tokens without framework overhead. Laravel Livewire eliminates need for heavy JS frameworks.

### V. No Testing (Code Quality via Review)

This project explicitly DOES NOT include automated tests:

- No unit tests, no integration tests, no end-to-end tests
- Quality assurance happens through manual testing and code review
- Features are validated by running the application
- Templates must never reference test directories or testing requirements
- Focus development time on feature delivery

**Rationale**: For small-scale projects with limited scope, the overhead of test infrastructure outweighs benefits. Manual testing during development combined with clean code practices provides sufficient quality assurance.

## Technology Stack

This section defines the MANDATORY technology choices for the project:

**Backend Framework**: Laravel with Livewire

- Livewire MUST be used for all dynamic UI interactions
- Server-side rendering with reactive components
- Minimal JavaScript - let Livewire handle interactivity

**Frontend Styling**: Custom CSS with layers and Open Props

- CSS layers MUST organize styles by priority (@layer reset, base, components, utilities)
- Open Props (open-props.style) MUST be used for design tokens
- No CSS frameworks (no Tailwind, Bootstrap, etc.)
- Embrace modern CSS features (container queries, :has(), cascade layers)

**Database**: Laravel-compatible database (SQLite for development, PostgreSQL/MySQL for production)

**Asset Management**: Vite (Laravel default)

## Development Workflow

**Branch Strategy**: Feature branches from main, squash merge on completion

**Code Review**: All changes reviewed for principle compliance before merge

**Documentation**: README and inline comments for non-obvious logic

**Deployment**: Simple deployment process - no complex CI/CD unless project grows

## Governance

This constitution supersedes all other development practices and guidelines. Changes to these principles require:

1. Documented justification for the amendment
2. Update to the version number following semantic versioning:
   - MAJOR: Backward-incompatible principle changes or removals
   - MINOR: New principles added or significant expansions
   - PATCH: Clarifications, wording improvements, minor refinements
3. Sync check across all template files in `.specify/templates/`
4. Update to Last Amended date

All feature specifications, implementation plans, and task lists MUST verify compliance with these principles. Complexity that violates principles must be explicitly justified or rejected.

Templates and command workflows in `.specify/templates/` are subordinate to this constitution and must align with the principles defined here.

**Version**: 1.0.0 | **Ratified**: 2025-12-28 | **Last Amended**: 2025-12-28
