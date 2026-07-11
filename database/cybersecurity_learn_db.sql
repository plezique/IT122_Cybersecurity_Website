-- CyberSafe Learn Database Schema + Sample Data
-- Import via phpMyAdmin or: mysql -u root < cybersecurity_learn_db.sql

CREATE DATABASE IF NOT EXISTS cybersecurity_learn_db;
USE cybersecurity_learn_db;

-- Users table (passwords hashed with password_hash())
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Learning modules
CREATE TABLE modules (
    module_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    content TEXT NOT NULL,
    example_text TEXT,
    key_takeaway TEXT,
    category VARCHAR(50) NOT NULL,
    icon VARCHAR(30) DEFAULT 'shield',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Quick tips
CREATE TABLE tips (
    tip_id INT AUTO_INCREMENT PRIMARY KEY,
    tip_text TEXT NOT NULL,
    category VARCHAR(50) NOT NULL,
    is_featured TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Quiz questions
CREATE TABLE quiz_questions (
    question_id INT AUTO_INCREMENT PRIMARY KEY,
    question_text TEXT NOT NULL,
    option_a VARCHAR(255) NOT NULL,
    option_b VARCHAR(255) NOT NULL,
    option_c VARCHAR(255) NOT NULL,
    option_d VARCHAR(255) NOT NULL,
    correct_answer CHAR(1) NOT NULL,
    explanation TEXT NOT NULL,
    category VARCHAR(50) NOT NULL,
    quiz_type ENUM('phishing', 'awareness') DEFAULT 'awareness',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Quiz results (per logged-in user)
CREATE TABLE quiz_results (
    result_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    quiz_type VARCHAR(30) NOT NULL,
    score INT NOT NULL,
    total_questions INT NOT NULL,
    awareness_level VARCHAR(30),
    module_id INT NULL,
    date_taken TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (module_id) REFERENCES modules(module_id) ON DELETE SET NULL
);

-- Resources and glossary
CREATE TABLE resources (
    resource_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    url VARCHAR(255),
    category VARCHAR(50) NOT NULL,
    resource_type ENUM('tool', 'glossary') DEFAULT 'tool',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample admin user (password: admin123)
INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@cybersafe.local', '$2y$10$UY.beZU597hIWb9N1fAHnexvGvAGNpg6aiiPa2lCwztBHUPJXa.yu', 'admin');

-- Sample regular user (password: user123)
INSERT INTO users (username, email, password, role) VALUES
('demo_user', 'demo@cybersafe.local', '$2y$10$Z2tCGR5rlWzyFh7IkHonkengdNmJxr5pX.MkzD1Fh8yiiukembDwi', 'user');

-- Learning modules (8 topics)
INSERT INTO modules (title, content, example_text, key_takeaway, category, icon) VALUES
('Cybersecurity Basics', 'Cybersecurity is the practice of protecting computers, networks, and data from unauthorized access, theft, or damage. At its core, cybersecurity rests on three principles known as the CIA Triad: Confidentiality (keeping information private), Integrity (ensuring data is accurate and unaltered), and Availability (making sure systems and data are accessible when needed).\n\nCommon threats include malware (malicious software), phishing (tricking people into revealing information), ransomware (locking your files until you pay), and social engineering (manipulating people rather than breaking technology). Understanding these basics helps you recognize when something is wrong and take action before damage occurs.\n\nGood cybersecurity is not just for IT professionals. Every person who uses the internet plays a role in keeping themselves and their organization safe. Simple habits like updating software, using strong passwords, and thinking before you click can prevent the majority of attacks.', 'A student receives an email claiming their university account will be suspended unless they click a link and "verify" their password within one hour. The link goes to a fake login page. This is a phishing attack targeting confidentiality — the attacker wants to steal login credentials.', 'Cybersecurity protects confidentiality, integrity, and availability. Most attacks target people, not just technology — stay alert and verify before you trust.', 'Basics', 'shield'),

('Password Security & MFA', 'Your password is often the only thing standing between your personal data and an attacker. A strong password should be at least 12 characters long, use a mix of uppercase, lowercase, numbers, and symbols, and never be reused across different accounts. Avoid common words, personal information (birthdays, pet names), and predictable patterns like "Password123!".\n\nPassword managers like Bitwarden or 1Password can generate and store unique passwords for every account, so you only need to remember one master password. This is one of the most effective security improvements you can make.\n\nMulti-Factor Authentication (MFA) adds a second layer of protection beyond your password. Even if someone steals your password, they cannot log in without the second factor — usually a code from an app, a text message, or a hardware key. Enable MFA on email, banking, social media, and any account that offers it.', 'After a data breach at a shopping site, attackers try the same email and password combination on banking and email sites. Users who reused passwords lose access to multiple accounts. Users with unique passwords and MFA enabled remain protected.', 'Use long, unique passwords for every account. Enable MFA everywhere it is offered, and use a password manager to keep track.', 'Passwords', 'lock'),

('Phishing & Social Engineering', 'Phishing is when attackers send fake emails, texts, or messages designed to trick you into revealing passwords, financial information, or clicking malicious links. These messages often create urgency ("Your account will be closed!"), use official-looking logos, or appear to come from someone you trust.\n\nSocial engineering goes beyond email. Attackers may call pretending to be tech support, create fake social media profiles, or even manipulate you in person. The goal is always the same: exploit human trust and emotion rather than technical vulnerabilities.\n\nProtect yourself by verifying senders through a separate channel, hovering over links to check the real URL, never sharing passwords via email or phone, and reporting suspicious messages to your IT department or the impersonated organization.', 'You get a text saying "Your package delivery failed. Click here to reschedule." The link leads to a site asking for your credit card to pay a small "redelivery fee." The shipping company never sent this message — it is a phishing scam designed to steal payment information.', 'Never click links or open attachments from unexpected messages. When in doubt, contact the organization directly using a phone number or website you look up yourself.', 'Phishing', 'envelope'),

('Malware Types & Prevention', 'Malware is any software designed to harm your device or steal your data. Common types include viruses (spread by infecting files), worms (spread across networks automatically), trojans (disguised as legitimate software), ransomware (encrypts your files and demands payment), and spyware (secretly monitors your activity).\n\nMalware often arrives through email attachments, pirated software, infected USB drives, or compromised websites. Once installed, it can steal passwords, record keystrokes, or give attackers remote control of your computer.\n\nPrevention starts with keeping your operating system and applications updated, using reputable antivirus software, avoiding downloads from untrusted sources, and never plugging in unknown USB drives. Regular backups ensure you can recover even if ransomware strikes.', 'An employee downloads "free" project management software from an unofficial site. The installer contains a trojan that logs every keystroke, capturing login credentials for the company VPN. The attack could have been prevented by downloading only from the official vendor website.', 'Keep software updated, use antivirus protection, download only from trusted sources, and maintain regular backups of important files.', 'Malware', 'bug'),

('Network & Wi-Fi Safety', 'Your network connection is a gateway to your devices and data. Public Wi-Fi at cafes, airports, and hotels is convenient but often unsecured, meaning others on the same network could potentially intercept your traffic.\n\nWhen using public Wi-Fi, avoid accessing sensitive accounts (banking, email) unless you use a VPN (Virtual Private Network), which encrypts your connection. At home, change your router default password, use WPA3 or WPA2 encryption, and keep router firmware updated.\n\nBe cautious about connecting to networks with generic names like "Free WiFi" — attackers can create fake hotspots with convincing names to capture your data. Always verify network names with staff when possible.', 'At a coffee shop, someone creates a hotspot named "Starbucks_Free_WiFi." Nearby customers connect, and the attacker captures unencrypted login credentials sent over HTTP. Using a VPN or waiting until home would have protected their data.', 'Avoid sensitive tasks on public Wi-Fi without a VPN. Secure your home router with a strong password and modern encryption.', 'Network', 'wifi'),

('Safe Browsing Habits', 'The web is full of useful resources, but not every site is safe. Malicious websites can install malware, steal credentials through fake login pages, or trick you into downloading harmful files. Safe browsing habits reduce your exposure to these risks.\n\nLook for "https://" and the padlock icon in your browser address bar — this means your connection to the site is encrypted. Be skeptical of pop-ups claiming your computer is infected, offers that seem too good to be true, and sites asking for unnecessary personal information.\n\nUse browser security features like pop-up blockers and consider privacy-focused extensions. Clear your browser cache periodically, and log out of accounts when using shared computers.', 'A pop-up warns "Your PC has 47 viruses! Call this number now!" The user calls and is asked to install remote access software, giving the scammer full control. Legitimate security software never asks you to call a phone number from a browser pop-up.', 'Check for HTTPS, avoid suspicious pop-ups and downloads, and keep your browser updated with security features enabled.', 'Browsing', 'globe'),

('Mobile Device Security', 'Smartphones contain enormous amounts of personal data — photos, messages, banking apps, and location history. Protecting your mobile device is just as important as securing your computer.\n\nAlways use a screen lock (PIN, fingerprint, or face recognition) and enable automatic screen lock after a short idle period. Install apps only from official stores (Google Play, Apple App Store) and review app permissions before granting access. Disable Bluetooth and Wi-Fi when not in use, and keep your operating system updated.\n\nIf your phone is lost or stolen, use remote wipe features (Find My iPhone, Find My Device) to protect your data. Avoid storing sensitive passwords in unsecured notes apps — use your password manager instead.', 'A user installs a flashlight app that requests access to contacts, microphone, and location. The app secretly uploads this data to a server abroad. Checking permissions and choosing apps with minimal access could have prevented this.', 'Lock your screen, update your OS, download apps only from official stores, and review permissions carefully.', 'Mobile', 'mobile'),

('Social Media Privacy', 'Social media platforms collect and share vast amounts of personal information. Oversharing can expose you to identity theft, stalking, social engineering, and even physical security risks.\n\nReview your privacy settings on every platform — limit who can see your posts, contact information, and location. Be cautious about sharing travel plans, workplace details, or personal identifiers publicly. Remember that even "private" posts can be screenshotted and shared.\n\nThink before you post: would this information help someone impersonate you or answer your security questions? Enable two-factor authentication on social accounts and be wary of friend requests from people you do not know.', 'A job applicant posts a photo of their new employee ID badge on Instagram, visible to the public. The badge includes their full name, company, and employee number — information an attacker could use for targeted phishing against the company.', 'Audit privacy settings regularly, limit public personal details, and enable MFA on all social media accounts.', 'Privacy', 'users');

-- Quick tips by category
INSERT INTO tips (tip_text, category, is_featured) VALUES
('Use a unique password for every account — password managers make this easy.', 'Passwords', 1),
('Enable two-factor authentication on your email first — it protects password resets for all other accounts.', 'Passwords', 1),
('Never click "Unsubscribe" links in suspicious emails — it confirms your address is active.', 'Phishing', 1),
('Hover over links before clicking to see the real destination URL.', 'Phishing', 0),
('Keep your operating system and apps updated — updates fix security vulnerabilities.', 'General', 1),
('Back up important files regularly to an external drive or cloud service.', 'General', 0),
('Use a VPN when connecting to public Wi-Fi networks.', 'Network', 1),
('Change your home router default admin password immediately.', 'Network', 0),
('Download apps only from official app stores, never from random links.', 'Mobile', 1),
('Review app permissions — if a calculator app wants your contacts, say no.', 'Mobile', 0),
('Set social media profiles to friends-only and audit who can see your posts.', 'Privacy', 1),
('Do not post vacation photos until you are back home.', 'Privacy', 0),
('Look for https:// and the padlock icon before entering passwords on websites.', 'Browsing', 1),
('Use an ad blocker and pop-up blocker to reduce exposure to malicious ads.', 'Browsing', 0),
('Scan USB drives with antivirus before opening files from unknown sources.', 'Malware', 1),
('If you suspect malware, disconnect from the internet and run a full antivirus scan.', 'Malware', 0);

-- Phishing quiz questions
INSERT INTO quiz_questions (question_text, option_a, option_b, option_c, option_d, correct_answer, explanation, category, quiz_type) VALUES
('You receive an email from "IT Support" asking you to verify your password via a link. The sender address is it-support@company-helpdesk.net, not your company domain. What should you do?', 'Click the link and verify immediately', 'Reply with your password so they can verify', 'Report it as phishing and do not click the link', 'Forward it to all coworkers as a warning', 'C', 'Legitimate IT departments never ask for passwords via email. The mismatched domain is a clear phishing indicator. Report it to your actual IT team.', 'Phishing', 'phishing'),
('A text message says your bank account is locked and provides a link to unlock it. You were not expecting this message. What is the safest action?', 'Click the link to unlock your account quickly', 'Call the number in the text message', 'Open your banking app directly or visit the bank website you normally use', 'Reply STOP to the message', 'C', 'Always access financial accounts through official apps or websites you type in yourself, never through links in unexpected messages.', 'Phishing', 'phishing'),
('An email offers a free gift card if you complete a 2-minute survey. The link goes to bit.ly/survey-gift. What is suspicious?', 'The offer of a gift card', 'The shortened URL hiding the real destination', 'The 2-minute survey length', 'The email being in your inbox', 'B', 'Shortened URLs hide the real destination and are commonly used in phishing. Legitimate companies typically use their own domain.', 'Phishing', 'phishing'),
('Your manager emails asking you to urgently buy gift cards for a client and send the codes. The email looks like their usual style. What should you do?', 'Buy the gift cards immediately — your manager needs help', 'Verify the request by calling or messaging your manager through a known channel', 'Reply asking if this is legitimate', 'Forward the codes once purchased', 'B', 'This is a common CEO fraud / business email compromise scam. Always verify unusual financial requests through a separate communication channel.', 'Phishing', 'phishing'),
('An email claims your Netflix subscription expired. It has the Netflix logo but links to netflix-billing-update.com. What is wrong?', 'Netflix emails always look like this', 'The domain netflix-billing-update.com is not netflix.com', 'Subscription emails are always phishing', 'You should update billing immediately', 'B', 'Attackers use convincing logos but link to fake domains. Always check that the URL matches the official company domain.', 'Phishing', 'phishing');

-- Security awareness quiz questions
INSERT INTO quiz_questions (question_text, option_a, option_b, option_c, option_d, correct_answer, explanation, category, quiz_type) VALUES
('What does the "C" in the CIA Triad stand for?', 'Compliance', 'Confidentiality', 'Connectivity', 'Certification', 'B', 'Confidentiality ensures that information is accessible only to authorized individuals.', 'Basics', 'awareness'),
('What is the recommended minimum length for a strong password?', '6 characters', '8 characters', '12 characters', '4 characters', 'C', 'Security experts recommend at least 12 characters. Longer passwords are exponentially harder to crack.', 'Passwords', 'awareness'),
('What is MFA (Multi-Factor Authentication)?', 'Using multiple passwords', 'A second verification step beyond your password', 'Logging in from multiple devices', 'Having multiple email accounts', 'B', 'MFA requires something you know (password) plus something you have (phone code) or something you are (fingerprint).', 'Passwords', 'awareness'),
('Which is the safest way to use public Wi-Fi?', 'Do all your banking — it is fine', 'Use a VPN to encrypt your connection', 'Share the password with friends', 'Turn off your firewall for faster speed', 'B', 'A VPN encrypts your traffic on public networks, protecting it from interception.', 'Network', 'awareness'),
('What should you do if you suspect a phishing email?', 'Click the link to see if it is real', 'Reply and ask if it is legitimate', 'Report it and delete without clicking links', 'Forward it to everyone in your contacts', 'C', 'Reporting helps your organization block similar attacks. Never interact with suspicious links or attachments.', 'Phishing', 'awareness'),
('What is ransomware?', 'Software that speeds up your computer', 'Malware that encrypts files and demands payment', 'A type of antivirus program', 'A secure backup method', 'B', 'Ransomware locks your files and demands payment (usually cryptocurrency) for the decryption key.', 'Malware', 'awareness'),
('Why should you avoid reusing passwords across sites?', 'It is harder to remember', 'A breach on one site can compromise all accounts using that password', 'Websites do not allow it', 'It makes passwords weaker automatically', 'B', 'Credential stuffing attacks use leaked passwords from one breach to access accounts on other services.', 'Passwords', 'awareness'),
('What does HTTPS indicate?', 'The website is always trustworthy', 'Your connection to the website is encrypted', 'The website is government-approved', 'The website loads faster', 'B', 'HTTPS encrypts data between your browser and the server. It does not guarantee the site itself is trustworthy.', 'Browsing', 'awareness'),
('What is social engineering?', 'Building social media profiles', 'Manipulating people to reveal information or take actions', 'Engineering software for social networks', 'A type of network encryption', 'B', 'Social engineering exploits human psychology rather than technical vulnerabilities.', 'Phishing', 'awareness'),
('What is the best practice for software updates?', 'Never update — updates break things', 'Update only when you feel like it', 'Install security updates promptly', 'Only update free software', 'C', 'Security patches fix known vulnerabilities. Delaying updates leaves you exposed to attacks.', 'General', 'awareness');

-- Module-specific quiz questions (5–8 per learning module category)
INSERT INTO quiz_questions (question_text, option_a, option_b, option_c, option_d, correct_answer, explanation, category, quiz_type) VALUES
-- Basics (module 1)
('Which of the following is NOT part of the CIA Triad?', 'Confidentiality', 'Integrity', 'Availability', 'Connectivity', 'D', 'The CIA Triad consists of Confidentiality, Integrity, and Availability — the core principles of information security.', 'Basics', 'awareness'),
('What is the most common target of cyber attacks?', 'Network hardware only', 'People through social engineering', 'Power grids exclusively', 'Satellite systems', 'B', 'Most successful attacks exploit human trust and behavior rather than purely technical flaws.', 'Basics', 'awareness'),
('What does "integrity" mean in cybersecurity?', 'Data is kept private', 'Data is accurate and unaltered', 'Systems are always online', 'Passwords are encrypted', 'B', 'Integrity ensures information has not been tampered with or modified without authorization.', 'Basics', 'awareness'),
('Which is an example of a malware attack?', 'A phishing email asking for your password', 'Ransomware encrypting your files', 'Using a VPN on public Wi-Fi', 'Enabling two-factor authentication', 'B', 'Ransomware is a type of malware that encrypts files and demands payment for decryption.', 'Basics', 'awareness'),
('Why is cybersecurity important for everyday users?', 'Only IT professionals need to worry about it', 'Every internet user plays a role in staying safe', 'Antivirus software handles everything automatically', 'Cyber attacks only target large corporations', 'B', 'Individual habits like strong passwords and cautious clicking prevent the majority of attacks.', 'Basics', 'awareness'),
('What does "availability" mean in the CIA Triad?', 'Data is accessible to everyone', 'Systems and data are accessible when needed', 'Software is free to download', 'Backups are stored offsite', 'B', 'Availability ensures authorized users can access systems and data when they need them.', 'Basics', 'awareness'),

-- Passwords (module 2)
('Which password is the strongest?', 'password123', 'P@ssw0rd!', 'Tr0ub4dor&3', 'correct-horse-battery-staple-2024!', 'D', 'Long passphrases with mixed characters are much harder to crack than short complex passwords.', 'Passwords', 'awareness'),
('What is the main benefit of a password manager?', 'It makes passwords shorter', 'It generates and stores unique passwords for every account', 'It shares passwords with your team', 'It eliminates the need for MFA', 'B', 'Password managers let you use a unique strong password for every account without memorizing them all.', 'Passwords', 'awareness'),
('Which account should you enable MFA on first?', 'Your email account', 'A gaming forum', 'A shopping site you rarely use', 'A social media account you never post on', 'A', 'Your email account protects password resets for all your other accounts — securing it first is critical.', 'Passwords', 'awareness'),
('What is credential stuffing?', 'Creating new passwords regularly', 'Using leaked passwords from one breach to access accounts on other sites', 'Encrypting passwords in a database', 'Sharing passwords with family members', 'B', 'Attackers use stolen username/password pairs from one breach to try logging into other services.', 'Passwords', 'awareness'),
('Which habit weakens your password security the most?', 'Using a password manager', 'Reusing the same password across multiple sites', 'Enabling MFA on banking apps', 'Using passphrases longer than 12 characters', 'B', 'Password reuse means one breach can compromise all accounts sharing that password.', 'Passwords', 'awareness'),

-- Malware (module 4)
('Which type of malware spreads automatically across networks without user action?', 'Trojan', 'Worm', 'Spyware', 'Adware', 'B', 'Worms self-replicate and spread across networks without requiring the user to run a file.', 'Malware', 'awareness'),
('What is a trojan?', 'Malware disguised as legitimate software', 'A virus that only affects trojan horses', 'Hardware that monitors keystrokes', 'A secure backup tool', 'A', 'Trojans trick users into installing them by appearing to be useful or legitimate programs.', 'Malware', 'awareness'),
('What is the safest way to avoid malware from downloads?', 'Download from any site with good reviews', 'Download only from official vendor websites or app stores', 'Disable your antivirus for faster downloads', 'Use pirated software to save money', 'B', 'Official sources are vetted and scanned; unofficial sites are a common malware delivery channel.', 'Malware', 'awareness'),
('Why are regular backups important for ransomware protection?', 'Backups prevent ransomware from installing', 'Backups let you restore files without paying the ransom', 'Backups encrypt your files automatically', 'Backups replace antivirus software', 'B', 'If you have recent backups, you can restore your files without paying attackers or losing data.', 'Malware', 'awareness'),
('What should you do if you suspect malware on your device?', 'Ignore it and hope it goes away', 'Disconnect from the internet and run a full antivirus scan', 'Pay any ransom demands immediately', 'Share the infected file with friends as a warning', 'B', 'Disconnecting limits damage spread, and a full scan can detect and remove the threat.', 'Malware', 'awareness'),
('Which is a common way malware enters a system?', 'Email attachments from unknown senders', 'Keeping software updated', 'Using HTTPS websites', 'Enabling a firewall', 'A', 'Malicious email attachments remain one of the most common malware delivery methods.', 'Malware', 'awareness'),

-- Network (module 5)
('Why is public Wi-Fi risky for sensitive activities?', 'It is always slower than home Wi-Fi', 'Others on the network may intercept unencrypted traffic', 'Public Wi-Fi blocks HTTPS connections', 'It requires a password to connect', 'B', 'On unsecured networks, attackers can potentially capture data sent without encryption.', 'Network', 'awareness'),
('What does a VPN do on public Wi-Fi?', 'Makes the connection faster', 'Encrypts your internet traffic', 'Blocks all websites', 'Shares your connection with others', 'B', 'A VPN creates an encrypted tunnel, protecting your data from interception on public networks.', 'Network', 'awareness'),
('What encryption should your home Wi-Fi use?', 'WEP', 'WPA3 or WPA2', 'No encryption for faster speed', 'HTTP', 'B', 'WPA3 and WPA2 provide strong encryption; WEP is outdated and easily cracked.', 'Network', 'awareness'),
('What is an evil twin attack?', 'Two hackers working together', 'A fake Wi-Fi hotspot set up to capture your data', 'A type of ransomware', 'A legitimate network backup system', 'B', 'Attackers create fake hotspots with convincing names to trick users into connecting.', 'Network', 'awareness'),
('What should you change on a new home router?', 'The Wi-Fi network name only', 'The default admin password', 'The color of the router LEDs', 'Nothing — defaults are secure', 'B', 'Default router passwords are publicly known and must be changed immediately.', 'Network', 'awareness'),
('When is it safest to access your bank account on the go?', 'On any public Wi-Fi network', 'Using your phone\'s mobile data or a trusted VPN', 'On a network named "Free_WiFi"', 'After sharing the Wi-Fi password with strangers', 'B', 'Mobile data and VPNs encrypt traffic, making sensitive transactions safer away from home.', 'Network', 'awareness'),

-- Browsing (module 6)
('What does the padlock icon in your browser address bar indicate?', 'The website is guaranteed safe', 'Your connection to the site is encrypted (HTTPS)', 'The site has no ads', 'The site is government-approved', 'B', 'HTTPS encrypts data in transit, but does not guarantee the website itself is trustworthy.', 'Browsing', 'awareness'),
('What should you do when a pop-up claims your computer has viruses?', 'Call the phone number shown immediately', 'Close the pop-up and run a scan with your installed antivirus', 'Enter your credit card to fix the problem', 'Click "OK" to remove the viruses', 'B', 'These pop-ups are scams. Legitimate security software never asks you to call a number from a browser pop-up.', 'Browsing', 'awareness'),
('Which URL is most likely a phishing site?', 'https://www.google.com', 'https://www.g00gle-security.com', 'https://accounts.google.com', 'https://support.google.com', 'B', 'Look-alike domains with misspellings or extra words are a common phishing tactic.', 'Browsing', 'awareness'),
('Why should you log out of accounts on shared computers?', 'To save battery life', 'To prevent the next user from accessing your account', 'To clear your browser history automatically', 'Logging out is not necessary', 'B', 'Staying logged in on shared devices lets anyone who uses the computer access your account.', 'Browsing', 'awareness'),
('What browser feature helps block malicious pop-ups?', 'Pop-up blocker', 'Auto-fill passwords', 'Bookmark sync', 'Dark mode', 'A', 'Pop-up blockers prevent many malicious pop-ups from appearing in the first place.', 'Browsing', 'awareness'),
('Before entering a password on a website, you should check for:', 'A colorful homepage design', 'HTTPS and a URL matching the expected domain', 'A high number of social media followers', 'Pop-up advertisements', 'B', 'Always verify HTTPS and that the domain matches the service you expect before entering credentials.', 'Browsing', 'awareness'),

-- Mobile (module 7)
('What is the first step to secure a new smartphone?', 'Install games from any website', 'Set up a screen lock (PIN, fingerprint, or face recognition)', 'Share your location with all apps', 'Disable all security updates', 'B', 'A screen lock is the first line of defense if your phone is lost or stolen.', 'Mobile', 'awareness'),
('Where should you download mobile apps?', 'Official app stores (Google Play, Apple App Store)', 'Random links sent via text message', 'Third-party APK sites', 'Email attachments', 'A', 'Official app stores review apps for malware; sideloading from unknown sources is risky.', 'Mobile', 'awareness'),
('A flashlight app requests access to your contacts and microphone. What should you do?', 'Grant all permissions — apps need them to work', 'Deny unnecessary permissions and consider a different app', 'Share the app with friends', 'Uninstall your antivirus', 'B', 'Apps should only request permissions relevant to their function. Excessive permissions are a red flag.', 'Mobile', 'awareness'),
('What should you do if your phone is lost or stolen?', 'Wait and hope someone returns it', 'Use remote wipe/lock features (Find My iPhone, Find My Device)', 'Post your phone number on social media', 'Nothing — phones are replaceable', 'B', 'Remote wipe protects your personal data even if you cannot recover the physical device.', 'Mobile', 'awareness'),
('Why should you keep your mobile OS updated?', 'Updates always add new emojis', 'Updates patch security vulnerabilities', 'Updates make your phone slower on purpose', 'Updates are optional and never important', 'B', 'Mobile OS updates frequently include critical security patches for known vulnerabilities.', 'Mobile', 'awareness'),
('Which practice improves mobile security?', 'Storing passwords in an unsecured notes app', 'Using your password manager app on mobile', 'Leaving Bluetooth on at all times', 'Ignoring app permission requests', 'B', 'Password managers work on mobile too and are far safer than storing credentials in plain text.', 'Mobile', 'awareness'),

-- Privacy (module 8)
('Why should you review social media privacy settings regularly?', 'Platforms may change defaults and expose more data', 'Privacy settings slow down your feed', 'Settings cannot be changed once set', 'Only celebrities need privacy settings', 'A', 'Social platforms frequently update privacy defaults; regular audits keep your data protected.', 'Privacy', 'awareness'),
('Which post poses the biggest privacy risk?', 'A photo of your lunch at home', 'A vacation photo posted while you are still away', 'A shared news article', 'A meme about cybersecurity', 'B', 'Posting vacation photos while away signals that your home is unoccupied to potential criminals.', 'Privacy', 'awareness'),
('What information should you avoid sharing publicly on social media?', 'Your favorite movie genre', 'Your full birthdate, address, and workplace details', 'A photo of a landscape', 'A link to a news article', 'B', 'Personal identifiers help attackers answer security questions and craft targeted phishing attacks.', 'Privacy', 'awareness'),
('Why enable MFA on social media accounts?', 'It makes posting faster', 'It prevents unauthorized access even if your password is stolen', 'It hides your profile from search engines', 'It is required by law', 'B', 'MFA adds a second verification step, stopping attackers who have your password.', 'Privacy', 'awareness'),
('What should you do about friend requests from strangers?', 'Accept all requests to grow your network', 'Decline or ignore requests from people you do not know', 'Share your password to verify identity', 'Post their profile publicly', 'B', 'Fake profiles are used for social engineering, scams, and gathering personal information.', 'Privacy', 'awareness'),
('Even "private" social media posts can be risky because:', 'Private posts are always public anyway', 'Others can screenshot and share your content', 'Private posts expire after 24 hours', 'Private posts are stored unencrypted', 'B', 'Screenshots and forwards mean content shared privately can still spread beyond your intended audience.', 'Privacy', 'awareness');

-- Resources (tools)
INSERT INTO resources (name, description, url, category, resource_type) VALUES
('Bitwarden', 'Free, open-source password manager with cross-device sync and strong encryption.', 'https://bitwarden.com', 'Password Management', 'tool'),
('1Password', 'Premium password manager with family and business plans and excellent usability.', 'https://1password.com', 'Password Management', 'tool'),
('NordVPN', 'Popular VPN service that encrypts your internet connection on public Wi-Fi.', 'https://nordvpn.com', 'Network Security', 'tool'),
('Malwarebytes', 'Antivirus and anti-malware tool that detects and removes threats.', 'https://malwarebytes.com', 'Antivirus', 'tool'),
('Windows Defender', 'Built-in antivirus for Windows — enable and keep it updated.', 'https://www.microsoft.com/en-us/windows/comprehensive-security', 'Antivirus', 'tool'),
('Have I Been Pwned', 'Check if your email has appeared in known data breaches.', 'https://haveibeenpwned.com', 'Account Security', 'tool'),
('Google Authenticator', 'Free app for generating MFA codes on your phone.', 'https://googleauthenticator.google.com', 'Authentication', 'tool'),
('uBlock Origin', 'Browser extension that blocks ads and malicious trackers.', 'https://ublockorigin.com', 'Browsing', 'tool');

-- Glossary terms
INSERT INTO resources (name, description, url, category, resource_type) VALUES
('Phishing', 'A scam where attackers impersonate trusted entities to steal credentials or personal data, usually via email or text.', NULL, 'Threats', 'glossary'),
('Malware', 'Malicious software designed to damage, disrupt, or gain unauthorized access to computer systems.', NULL, 'Threats', 'glossary'),
('Ransomware', 'Malware that encrypts your files and demands payment to restore access.', NULL, 'Threats', 'glossary'),
('MFA / 2FA', 'Multi-Factor Authentication — requires two or more verification methods to log in.', NULL, 'Authentication', 'glossary'),
('VPN', 'Virtual Private Network — encrypts your internet traffic and hides your IP address.', NULL, 'Network', 'glossary'),
('CIA Triad', 'Core security model: Confidentiality, Integrity, and Availability of information.', NULL, 'Fundamentals', 'glossary'),
('Social Engineering', 'Manipulating people into revealing confidential information or performing actions that compromise security.', NULL, 'Threats', 'glossary'),
('Encryption', 'Converting data into a coded format that can only be read with the correct key or password.', NULL, 'Fundamentals', 'glossary'),
('Zero-Day', 'A software vulnerability unknown to the vendor, with no patch available yet.', NULL, 'Threats', 'glossary'),
('Firewall', 'A security system that monitors and controls incoming and outgoing network traffic.', NULL, 'Network', 'glossary');
