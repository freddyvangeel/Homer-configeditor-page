# Homer Config Page

A lightweight, drop-in browser-based config editor for the [Homer dashboard](https://github.com/bastienwirtz/homer).  
No backend, no Python, no Flask — just a self-contained `index.html` and `save.php` for local editing of `config.yml`.

---

## ✨ Features

- Edit `config.yml` directly from your browser
- No dependencies beyond PHP (already included on many systems)
- Simple textarea + Save button
- "Saved" confirmation message
- Helpful YAML and icon tips
- Easily extendable (new link generator planned)

---

## 📦 Folder structure
├── index.html # Main editor GUI
├── save.php # Handles saving to config.yml
└── config.yml # Symlink to actual config file (optional)


---

## 🔧 Installation

1. Copy the `edit/` folder into your Homer deployment, e.g.:
> /var/www/homer/edit/

2. Ensure your Homer config file lives at:
> /var/www/homer/assets/config.yml

3. Symlink the live config (optional for live loading):
```
ln -sf /var/www/homer/assets/config.yml /var/www/homer/edit/config.yml
```

4. Make sure www-data (or your web server user) owns everything:
> chown -R www-data:www-data /var/www/homer

🌐 Serve with NGINX (example)
Add this to your Homer server {} block:
```
location /edit/ {
    root /var/www/homer;
    index index.html;
    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```
> Adjust php8.2-fpm.sock to match your installed version.

🛠 Usage
Open `http://server.local/edit/`

View and modify your full config.yml in the text area
Click Save
You’ll see a green ✓ Saved! confirmation
Refresh http://server.local/ to see your changes live

🔗 Icon Reference
Use Font Awesome icons:
➡️ https://fontawesome.com/icons
- icon: fas fa-network-wired
- icon: fas fa-plug

🧠 YAML Formatting Tips
- Use 2 spaces per indentation level (or consistent 4)
- No tabs
- Keep child items aligned under their parent keys

🔄 Related Projects
joshobrien77/homerconfig — full GUI editor with Flask backend
This project — minimal, fast, drop-in version that integrates directly with existing Homer deployments

🔐 Security
This tool is intentionally simple and unauthenticated.
Use it only on trusted LANs. If needed, add authentication via:
- HTTP basic auth
- IP allowlists
- NGINX reverse proxy ACLs

