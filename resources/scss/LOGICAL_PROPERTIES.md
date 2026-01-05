# CSS Logical Properties Implementation Guide

This project uses **CSS logical properties** instead of physical properties for better internationalization (i18n) support and writing-mode flexibility.

## Why Logical Properties?

### The Problem with Physical Properties

Physical properties (`left`, `right`, `top`, `bottom`, `width`, `height`) are tied to the physical screen dimensions and don't adapt to different writing modes or text directions.

**Example Issues:**
- Arabic/Hebrew text flows right-to-left (RTL)
- Vertical writing modes (Japanese, Mongolian)
- Maintaining separate RTL stylesheets
- Inconsistent behavior across languages

### The Solution: Logical Properties

Logical properties adapt automatically to writing mode and text direction without additional code.

## Mapping: Physical → Logical

### Dimensions

| Physical Property | Logical Property | Description |
|------------------|------------------|-------------|
| `width` | `inline-size` | Size in reading direction (horizontal in LTR/RTL) |
| `height` | `block-size` | Size perpendicular to reading direction (vertical in LTR/RTL) |
| `max-width` | `max-inline-size` | Maximum inline size |
| `max-height` | `max-block-size` | Maximum block size |
| `min-width` | `min-inline-size` | Minimum inline size |
| `min-height` | `min-block-size` | Minimum block size |

### Margins

| Physical Property | Logical Property | Description |
|------------------|------------------|-------------|
| `margin-left` | `margin-inline-start` | Margin at the start of inline axis |
| `margin-right` | `margin-inline-end` | Margin at the end of inline axis |
| `margin-top` | `margin-block-start` | Margin at the start of block axis |
| `margin-bottom` | `margin-block-end` | Margin at the end of block axis |
| `margin: 0 auto` | `margin-inline: auto` | Auto margins on inline axis (centering) |

**Shorthand:**
```css
/* Physical */
margin-left: 1rem;
margin-right: 1rem;

/* Logical shorthand */
margin-inline: 1rem; /* Both start and end */
margin-inline: 1rem 2rem; /* Start and end different */
```

### Padding

| Physical Property | Logical Property | Description |
|------------------|------------------|-------------|
| `padding-left` | `padding-inline-start` | Padding at the start of inline axis |
| `padding-right` | `padding-inline-end` | Padding at the end of inline axis |
| `padding-top` | `padding-block-start` | Padding at the start of block axis |
| `padding-bottom` | `padding-block-end` | Padding at the end of block axis |

**Shorthand:**
```css
/* Logical shorthand */
padding-inline: 1rem; /* Both start and end */
padding-block: 2rem; /* Both start and end */
```

### Borders

| Physical Property | Logical Property | Description |
|------------------|------------------|-------------|
| `border-left` | `border-inline-start` | Border at the start of inline axis |
| `border-right` | `border-inline-end` | Border at the end of inline axis |
| `border-top` | `border-block-start` | Border at the start of block axis |
| `border-bottom` | `border-block-end` | Border at the end of block axis |

### Positioning (Inset Properties)

| Physical Property | Logical Property | Description |
|------------------|------------------|-------------|
| `left` | `inset-inline-start` | Position from start of inline axis |
| `right` | `inset-inline-end` | Position from end of inline axis |
| `top` | `inset-block-start` | Position from start of block axis |
| `bottom` | `inset-block-end` | Position from end of block axis |

**Shorthand:**
```css
/* Physical */
top: 0;
left: 0;
right: 0;
bottom: 0;

/* Logical shorthand */
inset: 0; /* All four sides */
inset-inline: 0; /* Both inline sides */
inset-block: 0; /* Both block sides */
```

## Real-World Examples from This Project

### Container Width → Inline Size

**Before:**
```css
.wrapper {
    width: 100%;
    max-width: var(--wrapper-size);
}
```

**After:**
```css
.wrapper {
    max-inline-size: var(--wrapper-size);
    margin-inline: auto;
    padding-inline: var(--wrapper-padding);
}
```

### Margin Bottom → Margin Block End

**Before:**
```css
h1 {
    margin-bottom: var(--spacing-200);
}
```

**After:**
```css
h1 {
    margin-block-end: var(--spacing-200);
}
```

### Padding Right → Padding Inline End

**Before:**
```css
select {
    padding-right: var(--spacing-500);
}
```

**After:**
```css
select {
    padding-inline-end: var(--spacing-500);
}
```

### Border Bottom → Border Block End

**Before:**
```css
.navigation {
    border-bottom: 1px solid var(--color-border-primary);
}
```

**After:**
```css
.navigation {
    border-block-end: 1px solid var(--color-border-primary);
}
```

### Absolute Positioning → Inset

**Before:**
```css
.menu {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
}
```

**After:**
```css
.menu {
    position: absolute;
    inset-block-start: 100%;
    inset-inline-start: 0;
    inset-inline-end: 0;
}
```

### Sticky Navigation → Logical Inset

**Before:**
```css
.navigation {
    position: sticky;
    top: 0;
}
```

**After:**
```css
.navigation {
    position: sticky;
    inset-block-start: 0;
}
```

## Visual Guide: LTR vs RTL

### LTR (English, Spanish, French)
```
inline-start                    inline-end
↓                                      ↓
┌──────────────────────────────────────┐ ← block-start
│                                      │
│    [Content flows left to right]    │
│                                      │
└──────────────────────────────────────┘ ← block-end
```

### RTL (Arabic, Hebrew)
```
inline-end                      inline-start
↓                                      ↓
┌──────────────────────────────────────┐ ← block-start
│                                      │
│    [Content flows right to left]    │
│                                      │
└──────────────────────────────────────┘ ← block-end
```

### Vertical (Japanese, Mongolian)
```
block-start →  ┌─────────┐
               │ Content │
               │ flows   │
               │ top to  │
               │ bottom  │
block-end →    └─────────┘
```

## Complex Examples

### Responsive Navigation Menu

**Before (Physical):**
```css
.nav__menu {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    padding: 24px;
    width: 100%;
}
```

**After (Logical):**
```css
.nav__menu {
    position: absolute;
    inset-block-start: 100%;
    inset-inline: 0; /* Shorthand for start and end */
    padding-block: var(--spacing-300);
    padding-inline: var(--spacing-300);
    inline-size: 100%;
}
```

**Benefits:**
- ✅ Works in RTL languages automatically
- ✅ No need for `[dir="rtl"]` selectors
- ✅ Works with vertical writing modes
- ✅ One source of truth

### Card Layout

**Before (Physical):**
```css
.card {
    width: 100%;
    margin-bottom: 20px;
    padding: 16px 24px;
    border-bottom: 1px solid #ccc;
}

.card__title {
    margin-bottom: 8px;
}
```

**After (Logical):**
```css
.card {
    inline-size: 100%;
    margin-block-end: var(--spacing-250);
    padding-inline: var(--spacing-300);
    padding-block: var(--spacing-200);
    border-block-end: 1px solid var(--color-border-primary);
}

.card__title {
    margin-block-end: var(--spacing-100);
}
```

### Centered Container

**Before (Physical):**
```css
.container {
    width: 100%;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
    padding-left: 16px;
    padding-right: 16px;
}
```

**After (Logical):**
```css
.container {
    inline-size: 100%;
    max-inline-size: 1200px;
    margin-inline: auto; /* Shorthand! */
    padding-inline: var(--spacing-200); /* Shorthand! */
}
```

## Testing Logical Properties

### Test with RTL

Add to HTML:
```html
<html dir="rtl" lang="ar">
```

Or test specific elements:
```html
<div dir="rtl">
    <!-- Content automatically flips -->
</div>
```

### Test with DevTools

Chrome/Edge DevTools:
1. Inspect element
2. See computed styles show logical properties
3. Toggle writing-mode/direction to see changes

### Browser Support

| Property | Chrome | Firefox | Safari | Edge |
|----------|--------|---------|--------|------|
| Logical margins/padding | 69+ | 41+ | 12.1+ | 79+ |
| Logical borders | 69+ | 41+ | 12.1+ | 79+ |
| Logical sizing | 89+ | 41+ | 15.4+ | 89+ |
| Inset properties | 87+ | 66+ | 14.1+ | 87+ |

**Global support: 95%+ (all modern browsers)**

## Migration Checklist

✅ Replace `width` with `inline-size`  
✅ Replace `height` with `block-size`  
✅ Replace `margin-left/right` with `margin-inline-start/end`  
✅ Replace `margin-top/bottom` with `margin-block-start/end`  
✅ Replace `padding-left/right` with `padding-inline-start/end`  
✅ Replace `padding-top/bottom` with `padding-block-start/end`  
✅ Replace `border-left/right/top/bottom` with logical equivalents  
✅ Replace `left/right` with `inset-inline-start/end`  
✅ Replace `top/bottom` with `inset-block-start/end`  

## Common Patterns

### Auto-centering
```css
/* Old */
margin-left: auto;
margin-right: auto;

/* New */
margin-inline: auto;
```

### Full-width elements
```css
/* Old */
width: 100%;

/* New */
inline-size: 100%;
```

### Vertical spacing
```css
/* Old */
margin-top: 16px;
margin-bottom: 16px;

/* New */
margin-block: var(--spacing-200);
```

### Horizontal padding
```css
/* Old */
padding-left: 24px;
padding-right: 24px;

/* New */
padding-inline: var(--spacing-300);
```

## Benefits Summary

### For Developers
- ✅ Write once, works for all writing modes
- ✅ No need for separate RTL stylesheets
- ✅ Cleaner, more semantic code
- ✅ Future-proof and standards-compliant

### For Users
- ✅ Consistent experience in all languages
- ✅ Proper layout in RTL languages
- ✅ Support for vertical writing modes
- ✅ Accessibility improvements

### For Business
- ✅ Easier internationalization
- ✅ Lower maintenance costs
- ✅ Faster time to market for new locales
- ✅ Better global reach

## Files Updated in This Project

All SCSS files now use logical properties:

- ✅ `global/_layout.scss` - Container and wrapper sizing
- ✅ `global/_typography.scss` - Heading and paragraph margins
- ✅ `global/_forms.scss` - Input, select padding and margins
- ✅ `components/_navigation.scss` - Menu positioning and spacing
- ✅ `components/_footer.scss` - Border and margin
- ✅ `components/_recipe-card.scss` - Card dimensions and spacing
- ✅ `components/_recipe-detail.scss` - Detail page layout
- ✅ `components/_button.scss` - Button sizing
- ✅ `components/_filters.scss` - Filter input sizing

## When NOT to Use Logical Properties

### Keep Physical Properties For:
- **Aspect ratios** - Still use `width` and `height`
- **Object-fit/position** - Keep as-is
- **Transforms** - `translateX`, `translateY` still physical
- **Explicit physical needs** - Rare cases where you specifically need physical dimensions

## Resources

- [MDN: CSS Logical Properties](https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_logical_properties_and_values)
- [CSS Tricks: Logical Properties Guide](https://css-tricks.com/css-logical-properties-and-values/)
- [W3C Specification](https://www.w3.org/TR/css-logical-1/)
- [Can I Use: Logical Properties](https://caniuse.com/css-logical-props)

## Quick Reference Card

```css
/* DIMENSIONS */
width → inline-size
height → block-size

/* MARGINS */
margin-left → margin-inline-start
margin-right → margin-inline-end
margin-top → margin-block-start
margin-bottom → margin-block-end
margin: 0 auto → margin-inline: auto

/* PADDING */
padding-left → padding-inline-start
padding-right → padding-inline-end
padding-top → padding-block-start
padding-bottom → padding-block-end

/* BORDERS */
border-left → border-inline-start
border-right → border-inline-end
border-top → border-block-start
border-bottom → border-block-end

/* POSITIONING */
left → inset-inline-start
right → inset-inline-end
top → inset-block-start
bottom → inset-block-end
```

---

**Note:** This project is fully internationalized with logical properties. No additional work needed for RTL or vertical writing modes! 🌍
