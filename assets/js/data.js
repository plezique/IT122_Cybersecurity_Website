const CYBERSAFE_DATA = {
  siteName: "CyberSafe Learn",
  siteTagline: "Learn Cybersecurity. Stay Safe Online.",
  modules: [
    {
      id: 1,
      title: "Cybersecurity Basics",
      content: "Cybersecurity is the practice of protecting computers, networks, and data from unauthorized access, theft, or damage. At its core, cybersecurity rests on three principles known as the CIA Triad: Confidentiality (keeping information private), Integrity (ensuring data is accurate and unaltered), and Availability (making sure systems and data are accessible when needed).\n\nCommon threats include malware (malicious software), phishing (tricking people into revealing information), ransomware (locking your files until you pay), and social engineering (manipulating people rather than breaking technology). Understanding these basics helps you recognize when something is wrong and take action before damage occurs.\n\nGood cybersecurity is not just for IT professionals. Every person who uses the internet plays a role in keeping themselves and their organization safe. Simple habits like updating software, using strong passwords, and thinking before you click can prevent the majority of attacks.",
      example_text: "A student receives an email claiming their university account will be suspended unless they click a link and \"verify\" their password within one hour. The link goes to a fake login page. This is a phishing attack targeting confidentiality — the attacker wants to steal login credentials.",
      key_takeaway: "Cybersecurity protects confidentiality, integrity, and availability. Most attacks target people, not just technology — stay alert and verify before you trust.",
      category: "Basics",
      icon: "shield"
    },
    {
      id: 2,
      title: "Password Security & MFA",
      content: "Your password is often the only thing standing between your personal data and an attacker. A strong password should be at least 12 characters long, use a mix of uppercase, lowercase, numbers, and symbols, and never be reused across different accounts. Avoid common words, personal information (birthdays, pet names), and predictable patterns like \"Password123!\".\n\nPassword managers like Bitwarden or 1Password can generate and store unique passwords for every account, so you only need to remember one master password. This is one of the most effective security improvements you can make.\n\nMulti-Factor Authentication (MFA) adds a second layer of protection beyond your password. Even if someone steals your password, they cannot log in without the second factor — usually a code from an app, a text message, or a hardware key. Enable MFA on email, banking, social media, and any account that offers it.",
      example_text: "After a data breach at a shopping site, attackers try the same email and password combination on banking and email sites. Users who reused passwords lose access to multiple accounts. Users with unique passwords and MFA enabled remain protected.",
      key_takeaway: "Use long, unique passwords for every account. Enable MFA everywhere it is offered, and use a password manager to keep track.",
      category: "Passwords",
      icon: "lock"
    },
    {
      id: 3,
      title: "Phishing & Social Engineering",
      content: "Phishing is when attackers send fake emails, texts, or messages designed to trick you into revealing passwords, financial information, or clicking malicious links. These messages often create urgency (\"Your account will be closed!\"), use official-looking logos, or appear to come from someone you trust.\n\nSocial engineering goes beyond email. Attackers may call pretending to be tech support, create fake social media profiles, or even manipulate you in person. The goal is always the same: exploit human trust and emotion rather than technical vulnerabilities.\n\nProtect yourself by verifying senders through a separate channel, hovering over links to check the real URL, never sharing passwords via email or phone, and reporting suspicious messages to your IT department or the impersonated organization.",
      example_text: "You get a text saying \"Your package delivery failed. Click here to reschedule.\" The link leads to a site asking for your credit card to pay a small \"redelivery fee.\" The shipping company never sent this message — it is a phishing scam designed to steal payment information.",
      key_takeaway: "Never click links or open attachments from unexpected messages. When in doubt, contact the organization directly using a phone number or website you look up yourself.",
      category: "Phishing",
      icon: "envelope"
    },
    {
      id: 4,
      title: "Malware Types & Prevention",
      content: "Malware is any software designed to harm your device or steal your data. Common types include viruses (spread by infecting files), worms (spread across networks automatically), trojans (disguised as legitimate software), ransomware (encrypts your files and demands payment), and spyware (secretly monitors your activity).\n\nMalware often arrives through email attachments, pirated software, infected USB drives, or compromised websites. Once installed, it can steal passwords, record keystrokes, or give attackers remote control of your computer.\n\nPrevention starts with keeping your operating system and applications updated, using reputable antivirus software, avoiding downloads from untrusted sources, and never plugging in unknown USB drives. Regular backups ensure you can recover even if ransomware strikes.",
      example_text: "An employee downloads \"free\" project management software from an unofficial site. The installer contains a trojan that logs every keystroke, capturing login credentials for the company VPN. The attack could have been prevented by downloading only from the official vendor website.",
      key_takeaway: "Keep software updated, use antivirus protection, download only from trusted sources, and maintain regular backups of important files.",
      category: "Malware",
      icon: "bug"
    },
    {
      id: 5,
      title: "Network & Wi-Fi Safety",
      content: "Your network connection is a gateway to your devices and data. Public Wi-Fi at cafes, airports, and hotels is convenient but often unsecured, meaning others on the same network could potentially intercept your traffic.\n\nWhen using public Wi-Fi, avoid accessing sensitive accounts (banking, email) unless you use a VPN (Virtual Private Network), which encrypts your connection. At home, change your router default password, use WPA3 or WPA2 encryption, and keep router firmware updated.\n\nBe cautious about connecting to networks with generic names like \"Free WiFi\" — attackers can create fake hotspots with convincing names to capture your data. Always verify network names with staff when possible.",
      example_text: "At a coffee shop, someone creates a hotspot named \"Starbucks_Free_WiFi.\" Nearby customers connect, and the attacker captures unencrypted login credentials sent over HTTP. Using a VPN or waiting until home would have protected their data.",
      key_takeaway: "Avoid sensitive tasks on public Wi-Fi without a VPN. Secure your home router with a strong password and modern encryption.",
      category: "Network",
      icon: "wifi"
    },
    {
      id: 6,
      title: "Safe Browsing Habits",
      content: "The web is full of useful resources, but not every site is safe. Malicious websites can install malware, steal credentials through fake login pages, or trick you into downloading harmful files. Safe browsing habits reduce your exposure to these risks.\n\nLook for \"https://\" and the padlock icon in your browser address bar — this means your connection to the site is encrypted. Be skeptical of pop-ups claiming your computer is infected, offers that seem too good to be true, and sites asking for unnecessary personal information.\n\nUse browser security features like pop-up blockers and consider privacy-focused extensions. Clear your browser cache periodically, and log out of accounts when using shared computers.",
      example_text: "A pop-up warns \"Your PC has 47 viruses! Call this number now!\" The user calls and is asked to install remote access software, giving the scammer full control. Legitimate security software never asks you to call a phone number from a browser pop-up.",
      key_takeaway: "Check for HTTPS, avoid suspicious pop-ups and downloads, and keep your browser updated with security features enabled.",
      category: "Browsing",
      icon: "globe"
    },
    {
      id: 7,
      title: "Mobile Device Security",
      content: "Smartphones contain enormous amounts of personal data — photos, messages, banking apps, and location history. Protecting your mobile device is just as important as securing your computer.\n\nAlways use a screen lock (PIN, fingerprint, or face recognition) and enable automatic screen lock after a short idle period. Install apps only from official stores (Google Play, Apple App Store) and review app permissions before granting access. Disable Bluetooth and Wi-Fi when not in use, and keep your operating system updated.\n\nIf your phone is lost or stolen, use remote wipe features (Find My iPhone, Find My Device) to protect your data. Avoid storing sensitive passwords in unsecured notes apps — use your password manager instead.",
      example_text: "A user installs a flashlight app that requests access to contacts, microphone, and location. The app secretly uploads this data to a server abroad. Checking permissions and choosing apps with minimal access could have prevented this.",
      key_takeaway: "Lock your screen, update your OS, download apps only from official stores, and review permissions carefully.",
      category: "Mobile",
      icon: "mobile"
    },
    {
      id: 8,
      title: "Social Media Privacy",
      content: "Social media platforms collect and share vast amounts of personal information. Oversharing can expose you to identity theft, stalking, social engineering, and even physical security risks.\n\nReview your privacy settings on every platform — limit who can see your posts, contact information, and location. Be cautious about sharing travel plans, workplace details, or personal identifiers publicly. Remember that even \"private\" posts can be screenshotted and shared.\n\nThink before you post: would this information help someone impersonate you or answer your security questions? Enable two-factor authentication on social accounts and be wary of friend requests from people you do not know.",
      example_text: "A job applicant posts a photo of their new employee ID badge on Instagram, visible to the public. The badge includes their full name, company, and employee number — information an attacker could use for targeted phishing against the company.",
      key_takeaway: "Audit privacy settings regularly, limit public personal details, and enable MFA on all social media accounts.",
      category: "Privacy",
      icon: "users"
    },
  ],
  tips: [
    {
      tip_text: "Use a unique password for every account — password managers make this easy.",
      category: "Passwords",
      is_featured: true
    },
    {
      tip_text: "Enable two-factor authentication on your email first — it protects password resets for all other accounts.",
      category: "Passwords",
      is_featured: true
    },
    {
      tip_text: "Never click \"Unsubscribe\" links in suspicious emails — it confirms your address is active.",
      category: "Phishing",
      is_featured: true
    },
    {
      tip_text: "Hover over links before clicking to see the real destination URL.",
      category: "Phishing",
      is_featured: false
    },
    {
      tip_text: "Keep your operating system and apps updated — updates fix security vulnerabilities.",
      category: "General",
      is_featured: true
    },
    {
      tip_text: "Back up important files regularly to an external drive or cloud service.",
      category: "General",
      is_featured: false
    },
    {
      tip_text: "Use a VPN when connecting to public Wi-Fi networks.",
      category: "Network",
      is_featured: true
    },
    {
      tip_text: "Change your home router default admin password immediately.",
      category: "Network",
      is_featured: false
    },
    {
      tip_text: "Download apps only from official app stores, never from random links.",
      category: "Mobile",
      is_featured: true
    },
    {
      tip_text: "Review app permissions — if a calculator app wants your contacts, say no.",
      category: "Mobile",
      is_featured: false
    },
    {
      tip_text: "Set social media profiles to friends-only and audit who can see your posts.",
      category: "Privacy",
      is_featured: true
    },
    {
      tip_text: "Do not post vacation photos until you are back home.",
      category: "Privacy",
      is_featured: false
    },
    {
      tip_text: "Look for https:// and the padlock icon before entering passwords on websites.",
      category: "Browsing",
      is_featured: true
    },
    {
      tip_text: "Use an ad blocker and pop-up blocker to reduce exposure to malicious ads.",
      category: "Browsing",
      is_featured: false
    },
    {
      tip_text: "Scan USB drives with antivirus before opening files from unknown sources.",
      category: "Malware",
      is_featured: true
    },
    {
      tip_text: "If you suspect malware, disconnect from the internet and run a full antivirus scan.",
      category: "Malware",
      is_featured: false
    },
  ],
  questions: [
    {
      question_text: "You receive an email from \"IT Support\" asking you to verify your password via a link. The sender address is it-support@company-helpdesk.net, not your company domain. What should you do?",
      option_a: "Click the link and verify immediately",
      option_b: "Reply with your password so they can verify",
      option_c: "Report it as phishing and do not click the link",
      option_d: "Forward it to all coworkers as a warning",
      correct_answer: "C",
      explanation: "Legitimate IT departments never ask for passwords via email. The mismatched domain is a clear phishing indicator. Report it to your actual IT team.",
      category: "Phishing",
      quiz_type: "phishing"
    },
    {
      question_text: "A text message says your bank account is locked and provides a link to unlock it. You were not expecting this message. What is the safest action?",
      option_a: "Click the link to unlock your account quickly",
      option_b: "Call the number in the text message",
      option_c: "Open your banking app directly or visit the bank website you normally use",
      option_d: "Reply STOP to the message",
      correct_answer: "C",
      explanation: "Always access financial accounts through official apps or websites you type in yourself, never through links in unexpected messages.",
      category: "Phishing",
      quiz_type: "phishing"
    },
    {
      question_text: "An email offers a free gift card if you complete a 2-minute survey. The link goes to bit.ly/survey-gift. What is suspicious?",
      option_a: "The offer of a gift card",
      option_b: "The shortened URL hiding the real destination",
      option_c: "The 2-minute survey length",
      option_d: "The email being in your inbox",
      correct_answer: "B",
      explanation: "Shortened URLs hide the real destination and are commonly used in phishing. Legitimate companies typically use their own domain.",
      category: "Phishing",
      quiz_type: "phishing"
    },
    {
      question_text: "Your manager emails asking you to urgently buy gift cards for a client and send the codes. The email looks like their usual style. What should you do?",
      option_a: "Buy the gift cards immediately — your manager needs help",
      option_b: "Verify the request by calling or messaging your manager through a known channel",
      option_c: "Reply asking if this is legitimate",
      option_d: "Forward the codes once purchased",
      correct_answer: "B",
      explanation: "This is a common CEO fraud / business email compromise scam. Always verify unusual financial requests through a separate communication channel.",
      category: "Phishing",
      quiz_type: "phishing"
    },
    {
      question_text: "An email claims your Netflix subscription expired. It has the Netflix logo but links to netflix-billing-update.com. What is wrong?",
      option_a: "Netflix emails always look like this",
      option_b: "The domain netflix-billing-update.com is not netflix.com",
      option_c: "Subscription emails are always phishing",
      option_d: "You should update billing immediately",
      correct_answer: "B",
      explanation: "Attackers use convincing logos but link to fake domains. Always check that the URL matches the official company domain.",
      category: "Phishing",
      quiz_type: "phishing"
    },
    {
      question_text: "What does the \"C\" in the CIA Triad stand for?",
      option_a: "Compliance",
      option_b: "Confidentiality",
      option_c: "Connectivity",
      option_d: "Certification",
      correct_answer: "B",
      explanation: "Confidentiality ensures that information is accessible only to authorized individuals.",
      category: "Basics",
      quiz_type: "awareness"
    },
    {
      question_text: "What is the recommended minimum length for a strong password?",
      option_a: "6 characters",
      option_b: "8 characters",
      option_c: "12 characters",
      option_d: "4 characters",
      correct_answer: "C",
      explanation: "Security experts recommend at least 12 characters. Longer passwords are exponentially harder to crack.",
      category: "Passwords",
      quiz_type: "awareness"
    },
    {
      question_text: "What is MFA (Multi-Factor Authentication)?",
      option_a: "Using multiple passwords",
      option_b: "A second verification step beyond your password",
      option_c: "Logging in from multiple devices",
      option_d: "Having multiple email accounts",
      correct_answer: "B",
      explanation: "MFA requires something you know (password) plus something you have (phone code) or something you are (fingerprint).",
      category: "Passwords",
      quiz_type: "awareness"
    },
    {
      question_text: "Which is the safest way to use public Wi-Fi?",
      option_a: "Do all your banking — it is fine",
      option_b: "Use a VPN to encrypt your connection",
      option_c: "Share the password with friends",
      option_d: "Turn off your firewall for faster speed",
      correct_answer: "B",
      explanation: "A VPN encrypts your traffic on public networks, protecting it from interception.",
      category: "Network",
      quiz_type: "awareness"
    },
    {
      question_text: "What should you do if you suspect a phishing email?",
      option_a: "Click the link to see if it is real",
      option_b: "Reply and ask if it is legitimate",
      option_c: "Report it and delete without clicking links",
      option_d: "Forward it to everyone in your contacts",
      correct_answer: "C",
      explanation: "Reporting helps your organization block similar attacks. Never interact with suspicious links or attachments.",
      category: "Phishing",
      quiz_type: "awareness"
    },
    {
      question_text: "What is ransomware?",
      option_a: "Software that speeds up your computer",
      option_b: "Malware that encrypts files and demands payment",
      option_c: "A type of antivirus program",
      option_d: "A secure backup method",
      correct_answer: "B",
      explanation: "Ransomware locks your files and demands payment (usually cryptocurrency) for the decryption key.",
      category: "Malware",
      quiz_type: "awareness"
    },
    {
      question_text: "Why should you avoid reusing passwords across sites?",
      option_a: "It is harder to remember",
      option_b: "A breach on one site can compromise all accounts using that password",
      option_c: "Websites do not allow it",
      option_d: "It makes passwords weaker automatically",
      correct_answer: "B",
      explanation: "Credential stuffing attacks use leaked passwords from one breach to access accounts on other services.",
      category: "Passwords",
      quiz_type: "awareness"
    },
    {
      question_text: "What does HTTPS indicate?",
      option_a: "The website is always trustworthy",
      option_b: "Your connection to the website is encrypted",
      option_c: "The website is government-approved",
      option_d: "The website loads faster",
      correct_answer: "B",
      explanation: "HTTPS encrypts data between your browser and the server. It does not guarantee the site itself is trustworthy.",
      category: "Browsing",
      quiz_type: "awareness"
    },
    {
      question_text: "What is social engineering?",
      option_a: "Building social media profiles",
      option_b: "Manipulating people to reveal information or take actions",
      option_c: "Engineering software for social networks",
      option_d: "A type of network encryption",
      correct_answer: "B",
      explanation: "Social engineering exploits human psychology rather than technical vulnerabilities.",
      category: "Phishing",
      quiz_type: "awareness"
    },
    {
      question_text: "What is the best practice for software updates?",
      option_a: "Never update — updates break things",
      option_b: "Update only when you feel like it",
      option_c: "Install security updates promptly",
      option_d: "Only update free software",
      correct_answer: "C",
      explanation: "Security patches fix known vulnerabilities. Delaying updates leaves you exposed to attacks.",
      category: "General",
      quiz_type: "awareness"
    },
    {
      question_text: "Which of the following is NOT part of the CIA Triad?",
      option_a: "Confidentiality",
      option_b: "Integrity",
      option_c: "Availability",
      option_d: "Connectivity",
      correct_answer: "D",
      explanation: "The CIA Triad consists of Confidentiality, Integrity, and Availability — the core principles of information security.",
      category: "Basics",
      quiz_type: "awareness"
    },
    {
      question_text: "What is the most common target of cyber attacks?",
      option_a: "Network hardware only",
      option_b: "People through social engineering",
      option_c: "Power grids exclusively",
      option_d: "Satellite systems",
      correct_answer: "B",
      explanation: "Most successful attacks exploit human trust and behavior rather than purely technical flaws.",
      category: "Basics",
      quiz_type: "awareness"
    },
    {
      question_text: "What does \"integrity\" mean in cybersecurity?",
      option_a: "Data is kept private",
      option_b: "Data is accurate and unaltered",
      option_c: "Systems are always online",
      option_d: "Passwords are encrypted",
      correct_answer: "B",
      explanation: "Integrity ensures information has not been tampered with or modified without authorization.",
      category: "Basics",
      quiz_type: "awareness"
    },
    {
      question_text: "Which is an example of a malware attack?",
      option_a: "A phishing email asking for your password",
      option_b: "Ransomware encrypting your files",
      option_c: "Using a VPN on public Wi-Fi",
      option_d: "Enabling two-factor authentication",
      correct_answer: "B",
      explanation: "Ransomware is a type of malware that encrypts files and demands payment for decryption.",
      category: "Basics",
      quiz_type: "awareness"
    },
    {
      question_text: "Why is cybersecurity important for everyday users?",
      option_a: "Only IT professionals need to worry about it",
      option_b: "Every internet user plays a role in staying safe",
      option_c: "Antivirus software handles everything automatically",
      option_d: "Cyber attacks only target large corporations",
      correct_answer: "B",
      explanation: "Individual habits like strong passwords and cautious clicking prevent the majority of attacks.",
      category: "Basics",
      quiz_type: "awareness"
    },
    {
      question_text: "What does \"availability\" mean in the CIA Triad?",
      option_a: "Data is accessible to everyone",
      option_b: "Systems and data are accessible when needed",
      option_c: "Software is free to download",
      option_d: "Backups are stored offsite",
      correct_answer: "B",
      explanation: "Availability ensures authorized users can access systems and data when they need them.",
      category: "Basics",
      quiz_type: "awareness"
    },
    {
      question_text: "Which password is the strongest?",
      option_a: "password123",
      option_b: "P@ssw0rd!",
      option_c: "Tr0ub4dor&3",
      option_d: "correct-horse-battery-staple-2024!",
      correct_answer: "D",
      explanation: "Long passphrases with mixed characters are much harder to crack than short complex passwords.",
      category: "Passwords",
      quiz_type: "awareness"
    },
    {
      question_text: "What is the main benefit of a password manager?",
      option_a: "It makes passwords shorter",
      option_b: "It generates and stores unique passwords for every account",
      option_c: "It shares passwords with your team",
      option_d: "It eliminates the need for MFA",
      correct_answer: "B",
      explanation: "Password managers let you use a unique strong password for every account without memorizing them all.",
      category: "Passwords",
      quiz_type: "awareness"
    },
    {
      question_text: "Which account should you enable MFA on first?",
      option_a: "Your email account",
      option_b: "A gaming forum",
      option_c: "A shopping site you rarely use",
      option_d: "A social media account you never post on",
      correct_answer: "A",
      explanation: "Your email account protects password resets for all your other accounts — securing it first is critical.",
      category: "Passwords",
      quiz_type: "awareness"
    },
    {
      question_text: "What is credential stuffing?",
      option_a: "Creating new passwords regularly",
      option_b: "Using leaked passwords from one breach to access accounts on other sites",
      option_c: "Encrypting passwords in a database",
      option_d: "Sharing passwords with family members",
      correct_answer: "B",
      explanation: "Attackers use stolen username/password pairs from one breach to try logging into other services.",
      category: "Passwords",
      quiz_type: "awareness"
    },
    {
      question_text: "Which habit weakens your password security the most?",
      option_a: "Using a password manager",
      option_b: "Reusing the same password across multiple sites",
      option_c: "Enabling MFA on banking apps",
      option_d: "Using passphrases longer than 12 characters",
      correct_answer: "B",
      explanation: "Password reuse means one breach can compromise all accounts sharing that password.",
      category: "Passwords",
      quiz_type: "awareness"
    },
    {
      question_text: "Which type of malware spreads automatically across networks without user action?",
      option_a: "Trojan",
      option_b: "Worm",
      option_c: "Spyware",
      option_d: "Adware",
      correct_answer: "B",
      explanation: "Worms self-replicate and spread across networks without requiring the user to run a file.",
      category: "Malware",
      quiz_type: "awareness"
    },
    {
      question_text: "What is a trojan?",
      option_a: "Malware disguised as legitimate software",
      option_b: "A virus that only affects trojan horses",
      option_c: "Hardware that monitors keystrokes",
      option_d: "A secure backup tool",
      correct_answer: "A",
      explanation: "Trojans trick users into installing them by appearing to be useful or legitimate programs.",
      category: "Malware",
      quiz_type: "awareness"
    },
    {
      question_text: "What is the safest way to avoid malware from downloads?",
      option_a: "Download from any site with good reviews",
      option_b: "Download only from official vendor websites or app stores",
      option_c: "Disable your antivirus for faster downloads",
      option_d: "Use pirated software to save money",
      correct_answer: "B",
      explanation: "Official sources are vetted and scanned; unofficial sites are a common malware delivery channel.",
      category: "Malware",
      quiz_type: "awareness"
    },
    {
      question_text: "Why are regular backups important for ransomware protection?",
      option_a: "Backups prevent ransomware from installing",
      option_b: "Backups let you restore files without paying the ransom",
      option_c: "Backups encrypt your files automatically",
      option_d: "Backups replace antivirus software",
      correct_answer: "B",
      explanation: "If you have recent backups, you can restore your files without paying attackers or losing data.",
      category: "Malware",
      quiz_type: "awareness"
    },
    {
      question_text: "What should you do if you suspect malware on your device?",
      option_a: "Ignore it and hope it goes away",
      option_b: "Disconnect from the internet and run a full antivirus scan",
      option_c: "Pay any ransom demands immediately",
      option_d: "Share the infected file with friends as a warning",
      correct_answer: "B",
      explanation: "Disconnecting limits damage spread, and a full scan can detect and remove the threat.",
      category: "Malware",
      quiz_type: "awareness"
    },
    {
      question_text: "Which is a common way malware enters a system?",
      option_a: "Email attachments from unknown senders",
      option_b: "Keeping software updated",
      option_c: "Using HTTPS websites",
      option_d: "Enabling a firewall",
      correct_answer: "A",
      explanation: "Malicious email attachments remain one of the most common malware delivery methods.",
      category: "Malware",
      quiz_type: "awareness"
    },
    {
      question_text: "Why is public Wi-Fi risky for sensitive activities?",
      option_a: "It is always slower than home Wi-Fi",
      option_b: "Others on the network may intercept unencrypted traffic",
      option_c: "Public Wi-Fi blocks HTTPS connections",
      option_d: "It requires a password to connect",
      correct_answer: "B",
      explanation: "On unsecured networks, attackers can potentially capture data sent without encryption.",
      category: "Network",
      quiz_type: "awareness"
    },
    {
      question_text: "What does a VPN do on public Wi-Fi?",
      option_a: "Makes the connection faster",
      option_b: "Encrypts your internet traffic",
      option_c: "Blocks all websites",
      option_d: "Shares your connection with others",
      correct_answer: "B",
      explanation: "A VPN creates an encrypted tunnel, protecting your data from interception on public networks.",
      category: "Network",
      quiz_type: "awareness"
    },
    {
      question_text: "What encryption should your home Wi-Fi use?",
      option_a: "WEP",
      option_b: "WPA3 or WPA2",
      option_c: "No encryption for faster speed",
      option_d: "HTTP",
      correct_answer: "B",
      explanation: "WPA3 and WPA2 provide strong encryption; WEP is outdated and easily cracked.",
      category: "Network",
      quiz_type: "awareness"
    },
    {
      question_text: "What is an evil twin attack?",
      option_a: "Two hackers working together",
      option_b: "A fake Wi-Fi hotspot set up to capture your data",
      option_c: "A type of ransomware",
      option_d: "A legitimate network backup system",
      correct_answer: "B",
      explanation: "Attackers create fake hotspots with convincing names to trick users into connecting.",
      category: "Network",
      quiz_type: "awareness"
    },
    {
      question_text: "What should you change on a new home router?",
      option_a: "The Wi-Fi network name only",
      option_b: "The default admin password",
      option_c: "The color of the router LEDs",
      option_d: "Nothing — defaults are secure",
      correct_answer: "B",
      explanation: "Default router passwords are publicly known and must be changed immediately.",
      category: "Network",
      quiz_type: "awareness"
    },
    {
      question_text: "When is it safest to access your bank account on the go?",
      option_a: "On any public Wi-Fi network",
      option_b: "Using your phone's mobile data or a trusted VPN",
      option_c: "On a network named \"Free_WiFi\"",
      option_d: "After sharing the Wi-Fi password with strangers",
      correct_answer: "B",
      explanation: "Mobile data and VPNs encrypt traffic, making sensitive transactions safer away from home.",
      category: "Network",
      quiz_type: "awareness"
    },
    {
      question_text: "What does the padlock icon in your browser address bar indicate?",
      option_a: "The website is guaranteed safe",
      option_b: "Your connection to the site is encrypted (HTTPS)",
      option_c: "The site has no ads",
      option_d: "The site is government-approved",
      correct_answer: "B",
      explanation: "HTTPS encrypts data in transit, but does not guarantee the website itself is trustworthy.",
      category: "Browsing",
      quiz_type: "awareness"
    },
    {
      question_text: "What should you do when a pop-up claims your computer has viruses?",
      option_a: "Call the phone number shown immediately",
      option_b: "Close the pop-up and run a scan with your installed antivirus",
      option_c: "Enter your credit card to fix the problem",
      option_d: "Click \"OK\" to remove the viruses",
      correct_answer: "B",
      explanation: "These pop-ups are scams. Legitimate security software never asks you to call a number from a browser pop-up.",
      category: "Browsing",
      quiz_type: "awareness"
    },
    {
      question_text: "Which URL is most likely a phishing site?",
      option_a: "https://www.google.com",
      option_b: "https://www.g00gle-security.com",
      option_c: "https://accounts.google.com",
      option_d: "https://support.google.com",
      correct_answer: "B",
      explanation: "Look-alike domains with misspellings or extra words are a common phishing tactic.",
      category: "Browsing",
      quiz_type: "awareness"
    },
    {
      question_text: "Why should you log out of accounts on shared computers?",
      option_a: "To save battery life",
      option_b: "To prevent the next user from accessing your account",
      option_c: "To clear your browser history automatically",
      option_d: "Logging out is not necessary",
      correct_answer: "B",
      explanation: "Staying logged in on shared devices lets anyone who uses the computer access your account.",
      category: "Browsing",
      quiz_type: "awareness"
    },
    {
      question_text: "What browser feature helps block malicious pop-ups?",
      option_a: "Pop-up blocker",
      option_b: "Auto-fill passwords",
      option_c: "Bookmark sync",
      option_d: "Dark mode",
      correct_answer: "A",
      explanation: "Pop-up blockers prevent many malicious pop-ups from appearing in the first place.",
      category: "Browsing",
      quiz_type: "awareness"
    },
    {
      question_text: "Before entering a password on a website, you should check for:",
      option_a: "A colorful homepage design",
      option_b: "HTTPS and a URL matching the expected domain",
      option_c: "A high number of social media followers",
      option_d: "Pop-up advertisements",
      correct_answer: "B",
      explanation: "Always verify HTTPS and that the domain matches the service you expect before entering credentials.",
      category: "Browsing",
      quiz_type: "awareness"
    },
    {
      question_text: "What is the first step to secure a new smartphone?",
      option_a: "Install games from any website",
      option_b: "Set up a screen lock (PIN, fingerprint, or face recognition)",
      option_c: "Share your location with all apps",
      option_d: "Disable all security updates",
      correct_answer: "B",
      explanation: "A screen lock is the first line of defense if your phone is lost or stolen.",
      category: "Mobile",
      quiz_type: "awareness"
    },
    {
      question_text: "Where should you download mobile apps?",
      option_a: "Official app stores (Google Play, Apple App Store)",
      option_b: "Random links sent via text message",
      option_c: "Third-party APK sites",
      option_d: "Email attachments",
      correct_answer: "A",
      explanation: "Official app stores review apps for malware; sideloading from unknown sources is risky.",
      category: "Mobile",
      quiz_type: "awareness"
    },
    {
      question_text: "A flashlight app requests access to your contacts and microphone. What should you do?",
      option_a: "Grant all permissions — apps need them to work",
      option_b: "Deny unnecessary permissions and consider a different app",
      option_c: "Share the app with friends",
      option_d: "Uninstall your antivirus",
      correct_answer: "B",
      explanation: "Apps should only request permissions relevant to their function. Excessive permissions are a red flag.",
      category: "Mobile",
      quiz_type: "awareness"
    },
    {
      question_text: "What should you do if your phone is lost or stolen?",
      option_a: "Wait and hope someone returns it",
      option_b: "Use remote wipe/lock features (Find My iPhone, Find My Device)",
      option_c: "Post your phone number on social media",
      option_d: "Nothing — phones are replaceable",
      correct_answer: "B",
      explanation: "Remote wipe protects your personal data even if you cannot recover the physical device.",
      category: "Mobile",
      quiz_type: "awareness"
    },
    {
      question_text: "Why should you keep your mobile OS updated?",
      option_a: "Updates always add new emojis",
      option_b: "Updates patch security vulnerabilities",
      option_c: "Updates make your phone slower on purpose",
      option_d: "Updates are optional and never important",
      correct_answer: "B",
      explanation: "Mobile OS updates frequently include critical security patches for known vulnerabilities.",
      category: "Mobile",
      quiz_type: "awareness"
    },
    {
      question_text: "Which practice improves mobile security?",
      option_a: "Storing passwords in an unsecured notes app",
      option_b: "Using your password manager app on mobile",
      option_c: "Leaving Bluetooth on at all times",
      option_d: "Ignoring app permission requests",
      correct_answer: "B",
      explanation: "Password managers work on mobile too and are far safer than storing credentials in plain text.",
      category: "Mobile",
      quiz_type: "awareness"
    },
    {
      question_text: "Why should you review social media privacy settings regularly?",
      option_a: "Platforms may change defaults and expose more data",
      option_b: "Privacy settings slow down your feed",
      option_c: "Settings cannot be changed once set",
      option_d: "Only celebrities need privacy settings",
      correct_answer: "A",
      explanation: "Social platforms frequently update privacy defaults; regular audits keep your data protected.",
      category: "Privacy",
      quiz_type: "awareness"
    },
    {
      question_text: "Which post poses the biggest privacy risk?",
      option_a: "A photo of your lunch at home",
      option_b: "A vacation photo posted while you are still away",
      option_c: "A shared news article",
      option_d: "A meme about cybersecurity",
      correct_answer: "B",
      explanation: "Posting vacation photos while away signals that your home is unoccupied to potential criminals.",
      category: "Privacy",
      quiz_type: "awareness"
    },
    {
      question_text: "What information should you avoid sharing publicly on social media?",
      option_a: "Your favorite movie genre",
      option_b: "Your full birthdate, address, and workplace details",
      option_c: "A photo of a landscape",
      option_d: "A link to a news article",
      correct_answer: "B",
      explanation: "Personal identifiers help attackers answer security questions and craft targeted phishing attacks.",
      category: "Privacy",
      quiz_type: "awareness"
    },
    {
      question_text: "Why enable MFA on social media accounts?",
      option_a: "It makes posting faster",
      option_b: "It prevents unauthorized access even if your password is stolen",
      option_c: "It hides your profile from search engines",
      option_d: "It is required by law",
      correct_answer: "B",
      explanation: "MFA adds a second verification step, stopping attackers who have your password.",
      category: "Privacy",
      quiz_type: "awareness"
    },
    {
      question_text: "What should you do about friend requests from strangers?",
      option_a: "Accept all requests to grow your network",
      option_b: "Decline or ignore requests from people you do not know",
      option_c: "Share your password to verify identity",
      option_d: "Post their profile publicly",
      correct_answer: "B",
      explanation: "Fake profiles are used for social engineering, scams, and gathering personal information.",
      category: "Privacy",
      quiz_type: "awareness"
    },
    {
      question_text: "Even \"private\" social media posts can be risky because:",
      option_a: "Private posts are always public anyway",
      option_b: "Others can screenshot and share your content",
      option_c: "Private posts expire after 24 hours",
      option_d: "Private posts are stored unencrypted",
      correct_answer: "B",
      explanation: "Screenshots and forwards mean content shared privately can still spread beyond your intended audience.",
      category: "Privacy",
      quiz_type: "awareness"
    },
  ],
  tools: [
    {
      name: "Bitwarden",
      description: "Free, open-source password manager with cross-device sync and strong encryption.",
      url: "https://bitwarden.com",
      category: "Password Management"
    },
    {
      name: "1Password",
      description: "Premium password manager with family and business plans and excellent usability.",
      url: "https://1password.com",
      category: "Password Management"
    },
    {
      name: "NordVPN",
      description: "Popular VPN service that encrypts your internet connection on public Wi-Fi.",
      url: "https://nordvpn.com",
      category: "Network Security"
    },
    {
      name: "Malwarebytes",
      description: "Antivirus and anti-malware tool that detects and removes threats.",
      url: "https://malwarebytes.com",
      category: "Antivirus"
    },
    {
      name: "Windows Defender",
      description: "Built-in antivirus for Windows — enable and keep it updated.",
      url: "https://www.microsoft.com/en-us/windows/comprehensive-security",
      category: "Antivirus"
    },
    {
      name: "Have I Been Pwned",
      description: "Check if your email has appeared in known data breaches.",
      url: "https://haveibeenpwned.com",
      category: "Account Security"
    },
    {
      name: "Google Authenticator",
      description: "Free app for generating MFA codes on your phone.",
      url: "https://googleauthenticator.google.com",
      category: "Authentication"
    },
    {
      name: "uBlock Origin",
      description: "Browser extension that blocks ads and malicious trackers.",
      url: "https://ublockorigin.com",
      category: "Browsing"
    },
  ],
  glossary: [
    {
      name: "Phishing",
      description: "A scam where attackers impersonate trusted entities to steal credentials or personal data, usually via email or text.",
      category: "Threats"
    },
    {
      name: "Malware",
      description: "Malicious software designed to damage, disrupt, or gain unauthorized access to computer systems.",
      category: "Threats"
    },
    {
      name: "Ransomware",
      description: "Malware that encrypts your files and demands payment to restore access.",
      category: "Threats"
    },
    {
      name: "MFA / 2FA",
      description: "Multi-Factor Authentication — requires two or more verification methods to log in.",
      category: "Authentication"
    },
    {
      name: "VPN",
      description: "Virtual Private Network — encrypts your internet traffic and hides your IP address.",
      category: "Network"
    },
    {
      name: "CIA Triad",
      description: "Core security model: Confidentiality, Integrity, and Availability of information.",
      category: "Fundamentals"
    },
    {
      name: "Social Engineering",
      description: "Manipulating people into revealing confidential information or performing actions that compromise security.",
      category: "Threats"
    },
    {
      name: "Encryption",
      description: "Converting data into a coded format that can only be read with the correct key or password.",
      category: "Fundamentals"
    },
    {
      name: "Zero-Day",
      description: "A software vulnerability unknown to the vendor, with no patch available yet.",
      category: "Threats"
    },
    {
      name: "Firewall",
      description: "A security system that monitors and controls incoming and outgoing network traffic.",
      category: "Network"
    },
  ]
};
