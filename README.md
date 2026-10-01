# Flex Quiz – Ultra Customizable WordPress Quiz Plugin

**Version 2.0.0** – Built for maximum flexibility, clean architecture, and beautiful UX.

## Features (v2 Ultra)

### Core Quiz Experience
- **Flexible questions** – Any number of answers per question (2, 3, 4, 5+). Single or multi-select.
- **Progressive difficulty support** – Assign difficulty 1–5 and categories freely.
- **Category Icon Progress Bar** – Show icons + category labels as progress steps (or classic bar / numbered steps / circular).
- **Live Admin Preview** – See the quiz while editing.
- **Beautiful modern frontend** – CSS variables theming, responsive, accessible, smooth animations.
- **Server-side scoring** – Answers never exposed to the client.
- **Timer** (optional, whole quiz).
- **Explanations** after answers.
- **Pass / Fail messages** + percentage threshold.

### Admin & Builder
- Visual question builder (add / remove questions and answers).
- Per-question: text, answers, correct flag(s), category, icon (emoji or text), difficulty, points, type, explanation, image.
- Per-quiz design: primary/accent colors, progress style, timer, randomization, allow back navigation, result messages.
- Shortcode: `[flexquiz id="123"]`
- Gutenberg block ready.
- Analytics CPT for attempts (score, percentage, passed, answers).
- Global settings page.

### Technical
- PHP 8+ with `declare(strict_types=1)`
- Clean OOP + namespaces (`FlexQuiz\`)
- REST API for submit & preview
- Proper sanitization, nonces, capability checks
- Translation-ready
- No heavy dependencies

## Installation

1. Download the repo as ZIP or clone it.
2. Upload the `flex-quiz` folder to `/wp-content/plugins/`.
3. Activate **Flex Quiz** in WordPress admin.
4. Go to **Flex Quiz → Add New**.

## Usage

1. Create a new Quiz.
2. Use the **Quiz Builder** meta box to add questions.
   - Set different number of answers per question.
   - Assign categories and icons for the progress bar.
3. Configure **Quiz Settings & Design** (progress style = Category Icons recommended).
4. Publish.
5. Embed with shortcode `[flexquiz id="YOUR_ID"]` or use the Gutenberg block.

## Roadmap / Next Upgrades

- Drag-and-drop question ordering
- Full React-based admin builder
- Image answers fully wired
- Matching / ordering / fill-in-the-blank types
- Conditional branching
- PDF certificates
- Lead capture / email results
- Advanced analytics charts
- Import / Export JSON
- Personality / outcome quizzes
- WooCommerce paid quizzes

## License

GPL-2.0-or-later

---

Built with ❤️ for maximum customizability.
