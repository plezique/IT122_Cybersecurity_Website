# Content Expansion Prompt: Resources Section

## Objective
Expand the Resources page with a broader, well-organized set of tools, references, and links — grouped by category — so it feels like a genuinely useful hub, not a short afterthought list.

---

## 1. Password Managers
- **Bitwarden** — Free, open-source, cross-platform password manager
- **1Password** — Paid, polished UX, strong for teams/families
- **KeePassXC** — Free, offline/local password vault (good for privacy-focused users)

## 2. VPN Services
- **ProtonVPN** — Free tier available, based in Switzerland (strong privacy laws)
- **Mullvad VPN** — Privacy-first, no account email required
- **Windscribe** — Free tier with decent data allowance, good for casual use

## 3. Antivirus / Anti-Malware Tools
- **Malwarebytes** — Strong at catching malware traditional antivirus misses
- **Windows Defender** (built-in, Windows) — Solid baseline protection, no extra install needed
- **Bitdefender** — Well-reviewed paid option with lightweight system impact

## 4. Browser Privacy & Security Extensions
- **uBlock Origin** — Ad/tracker blocker, reduces malicious ad exposure
- **HTTPS Everywhere / built-in HTTPS enforcement** (note: mention modern browsers now do this natively)
- **Privacy Badger** (EFF) — Blocks invisible trackers automatically

## 5. Two-Factor Authentication (2FA) Apps
- **Google Authenticator**
- **Microsoft Authenticator**
- **Authy** — Supports multi-device sync (useful if switching phones often)

## 6. Data Breach & Security Check Tools
- **Have I Been Pwned** (haveibeenpwned.com) — Check if your email/password has been in a known data breach
- **Google Password Checkup** — Built into Chrome, flags reused/weak/breached passwords

## 7. Learning & News Sources (for going deeper)
- **Krebs on Security** — Respected independent cybersecurity journalism blog
- **National Cybersecurity Alliance** (staysafeonline.org) — Consumer-focused awareness resources
- **CISA (Cybersecurity & Infrastructure Security Agency)** — U.S. government resource with tips and alerts, useful even for non-U.S. users as a reference
- **OWASP** — More technical, but a good next-step reference if the user wants to go beyond basics (e.g., web app security)

## 8. Mobile Security Tools
- **Find My Device** (Google, built-in Android) — Locate/lock/erase lost devices
- **Find My iPhone** (Apple, built-in iOS) — Same for iOS
- **Signal** — Encrypted messaging app, good example to reference in the Mobile/Social Privacy modules

## 9. Glossary of Terms (expand existing glossary if present)
Add/ensure these terms are covered with short, plain-language definitions:
- Phishing
- Malware
- Ransomware
- Firewall
- VPN
- Encryption
- Two-Factor Authentication (2FA)
- Social Engineering
- Zero-Day Vulnerability
- Brute Force Attack
- Man-in-the-Middle Attack
- Public Key / Private Key
- Spoofing
- DDoS (Distributed Denial of Service)

---

## 2. Page Structure Update

- Group resources into clearly labeled category sections (matching the headers above: Password Managers, VPN Services, Antivirus Tools, etc.)
- Each resource entry should include:
  - Name
  - One-sentence plain-language description (what it does, why it's useful)
  - Link (external, opens in new tab)
  - Free/Paid tag (small badge, consistent with the site's existing tag/badge style — e.g., the "VERIFIED"/"ENCRYPTED" style tags already used on the site)
- Add a short intro line at the top of the Resources page (e.g., "Trusted tools and references to help you put these lessons into practice.")
- Since this content is pulled from the `resources` table in the database, make sure new entries are added there with the correct `category` field so they render in the right section automatically

---

## 3. Database Note

Insert new rows into the `resources` table for each item above, following the existing schema:
```sql
INSERT INTO resources (name, description, url, category) VALUES
('Bitwarden', 'Free, open-source password manager to securely store and generate passwords.', 'https://bitwarden.com', 'Password Managers'),
('Have I Been Pwned', 'Check if your email or password has appeared in a known data breach.', 'https://haveibeenpwned.com', 'Data Breach Check Tools');
-- (continue for remaining entries)
```

---

## 4. Deliverable

An expanded, categorized Resources page pulling from an updated `resources` table, styled consistently with the site's existing badge/tag design, giving users a genuinely useful set of tools and references beyond the original short list.
