-- Migration: expand Resources page with categorized tools and glossary terms
-- Run this against an existing cybersecurity_learn_db database after the initial import.

ALTER TABLE resources
    ADD COLUMN pricing ENUM('free', 'paid', 'freemium', 'built-in') DEFAULT 'free' AFTER category;

DELETE FROM resources WHERE resource_type = 'tool';

INSERT INTO resources (name, description, url, category, pricing, resource_type) VALUES
('Bitwarden', 'Free, open-source password manager to securely store and generate passwords across all your devices.', 'https://bitwarden.com', 'Password Managers', 'free', 'tool'),
('1Password', 'Polished paid password manager with strong family and team sharing features.', 'https://1password.com', 'Password Managers', 'paid', 'tool'),
('KeePassXC', 'Free, offline password vault that keeps your credentials on your own device for maximum privacy.', 'https://keepassxc.org', 'Password Managers', 'free', 'tool'),
('ProtonVPN', 'VPN with a free tier, based in Switzerland under strong privacy laws.', 'https://protonvpn.com', 'VPN Services', 'freemium', 'tool'),
('Mullvad VPN', 'Privacy-first VPN that does not require an email address to sign up.', 'https://mullvad.net', 'VPN Services', 'paid', 'tool'),
('Windscribe', 'VPN with a generous free tier, suitable for casual browsing on public Wi-Fi.', 'https://windscribe.com', 'VPN Services', 'freemium', 'tool'),
('Malwarebytes', 'Anti-malware tool that catches threats traditional antivirus software often misses.', 'https://www.malwarebytes.com', 'Antivirus Tools', 'freemium', 'tool'),
('Windows Defender', 'Built-in antivirus for Windows — solid baseline protection with no extra install needed.', 'https://www.microsoft.com/en-us/windows/comprehensive-security', 'Antivirus Tools', 'built-in', 'tool'),
('Bitdefender', 'Well-reviewed paid antivirus with lightweight system impact and strong detection rates.', 'https://www.bitdefender.com', 'Antivirus Tools', 'paid', 'tool'),
('uBlock Origin', 'Browser extension that blocks ads and trackers, reducing exposure to malicious ads.', 'https://ublockorigin.com', 'Browser Privacy & Security Extensions', 'free', 'tool'),
('Browser HTTPS Enforcement', 'Modern browsers upgrade connections to HTTPS by default — look for the padlock icon in the address bar.', 'https://support.google.com/chrome/answer/95617', 'Browser Privacy & Security Extensions', 'built-in', 'tool'),
('Privacy Badger', 'EFF browser extension that automatically blocks invisible trackers as you browse.', 'https://privacybadger.org', 'Browser Privacy & Security Extensions', 'free', 'tool'),
('Google Authenticator', 'Free mobile app that generates time-based codes for two-factor authentication.', 'https://googleauthenticator.google.com', 'Two-Factor Authentication (2FA) Apps', 'free', 'tool'),
('Microsoft Authenticator', 'Free authenticator app with push notifications for quick, passwordless sign-in.', 'https://www.microsoft.com/en-us/security/mobile-authenticator-app', 'Two-Factor Authentication (2FA) Apps', 'free', 'tool'),
('Authy', 'Authenticator app with multi-device sync, useful when switching phones.', 'https://authy.com', 'Two-Factor Authentication (2FA) Apps', 'free', 'tool'),
('Have I Been Pwned', 'Check if your email or password has appeared in a known data breach.', 'https://haveibeenpwned.com', 'Data Breach & Security Check Tools', 'free', 'tool'),
('Google Password Checkup', 'Built into Chrome and Google accounts — flags reused, weak, or breached saved passwords.', 'https://passwords.google.com', 'Data Breach & Security Check Tools', 'built-in', 'tool'),
('Krebs on Security', 'Independent cybersecurity journalism blog covering breaches, scams, and threat trends.', 'https://krebsonsecurity.com', 'Learning & News Sources', 'free', 'tool'),
('National Cybersecurity Alliance', 'Consumer-focused awareness resources and practical online safety guides.', 'https://staysafeonline.org', 'Learning & News Sources', 'free', 'tool'),
('CISA', 'U.S. government cybersecurity agency with alerts, tips, and incident reporting resources.', 'https://www.cisa.gov', 'Learning & News Sources', 'free', 'tool'),
('OWASP', 'Open Web Application Security Project — a technical reference for web application security.', 'https://owasp.org', 'Learning & News Sources', 'free', 'tool'),
('Find My Device', 'Built-in Android tool to locate, lock, or erase a lost or stolen phone remotely.', 'https://www.google.com/android/find', 'Mobile Security Tools', 'built-in', 'tool'),
('Find My iPhone', 'Built-in iOS feature to locate, lock, or erase a lost or stolen Apple device.', 'https://www.apple.com/icloud/find-my/', 'Mobile Security Tools', 'built-in', 'tool'),
('Signal', 'Encrypted messaging app that protects the content of your calls and texts.', 'https://signal.org', 'Mobile Security Tools', 'free', 'tool');

DELETE FROM resources WHERE resource_type = 'glossary';

INSERT INTO resources (name, description, url, category, resource_type) VALUES
('Phishing', 'A scam where attackers impersonate trusted entities to steal credentials or personal data, usually via email or text.', NULL, 'Threats', 'glossary'),
('Malware', 'Malicious software designed to damage, disrupt, or gain unauthorized access to computer systems.', NULL, 'Threats', 'glossary'),
('Ransomware', 'Malware that encrypts your files and demands payment to restore access.', NULL, 'Threats', 'glossary'),
('Firewall', 'A security system that monitors and controls incoming and outgoing network traffic.', NULL, 'Network', 'glossary'),
('VPN', 'Virtual Private Network — encrypts your internet traffic and hides your IP address from snoopers.', NULL, 'Network', 'glossary'),
('Encryption', 'Converting data into a coded format that can only be read with the correct key or password.', NULL, 'Fundamentals', 'glossary'),
('Two-Factor Authentication (2FA)', 'A login method that requires a second verification step beyond your password, such as a code from your phone.', NULL, 'Authentication', 'glossary'),
('Social Engineering', 'Manipulating people into revealing confidential information or performing actions that compromise security.', NULL, 'Threats', 'glossary'),
('Zero-Day Vulnerability', 'A software flaw unknown to the vendor with no security patch available yet.', NULL, 'Threats', 'glossary'),
('Brute Force Attack', 'An attack that tries every possible password combination until the correct one is found.', NULL, 'Threats', 'glossary'),
('Man-in-the-Middle Attack', 'An attack where someone secretly intercepts communication between two parties to steal or alter data.', NULL, 'Threats', 'glossary'),
('Public Key / Private Key', 'A cryptographic key pair used in encryption — the public key encrypts data, and only the matching private key can decrypt it.', NULL, 'Fundamentals', 'glossary'),
('Spoofing', 'Disguising communication to appear as if it comes from a trusted source, such as a fake email address or caller ID.', NULL, 'Threats', 'glossary'),
('DDoS (Distributed Denial of Service)', 'An attack that floods a website or server with traffic from many sources, making it unavailable to legitimate users.', NULL, 'Threats', 'glossary'),
('CIA Triad', 'Core security model: Confidentiality, Integrity, and Availability of information.', NULL, 'Fundamentals', 'glossary');
