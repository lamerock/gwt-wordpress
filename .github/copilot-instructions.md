# Project rules
- This is a WordPress theme being made compatible with PHP 8.3+.
- Follow WordPress Coding Standards; the ruleset is phpcs.xml.dist.
- Check code with: vendor\bin\phpcs <file>
- Auto-fix only with: vendor\bin\phpcbf <file>, then re-run phpcs.
- Escape output (esc_html, esc_attr, esc_url, wp_kses_post), sanitize input, use nonces.
- Don't edit foundation/, js/ vendor libraries, or vendor/.
- Make one small, focused change per commit; don't mix style fixes with logic fixes.