# Upload Image

**Initial version (2025-06-14)**

---

## 1. Source Code Location

If you're reading this file, you've likely downloaded the source code from:

- https://github.com/MichaelY223/upload-image/archive/refs/tags/v0.1.0.zip

After extracting the ZIP archive, you'll find the following files in the root directory:

- `upload_image.php`
- `get_image_info.py`
- `.gitignore` (can be ignored for local testing)
- `README.md` (this file)

---

## 2. Set Up a Localhost Testing Environment for PHP

### a. Download and Install XAMPP

1. Visit the official XAMPP website:  
   https://www.apachefriends.org/

2. Select the version appropriate for your operating system (Windows, Linux, or macOS).

   ![XAMPP Download](docs/image.png)

3. Run the installer and follow the installation wizard.
   - You can leave all settings at their defaults.
   - Choose the default installation location (`C:\xampp` on Windows).

---

### b. Prepare the Project Files

1. Open the XAMPP installation directory and navigate to:  
   `C:\xampp\htdocs\`

2. Inside `htdocs`, create a new folder. You can name it anything (e.g., `upload_project`).  
   _This folder name will be used in the browser URL later._

3. Copy the following files from the downloaded ZIP into the folder you just created:
   - `upload_image.php`
   - `get_image_info.py`

---

### c. Start Apache Server

1. Navigate to the root XAMPP installation directory (`C:\xampp`) and locate `xampp-control.exe`.
2. Double-click to open the **XAMPP Control Panel**.
3. In the control panel, click **Start** next to **Apache** to start the web server.

   ![XAMPP Control Panel](docs/image.png)

---

### d. Access the PHP Script in a Browser

- Open any web browser and go to: `http://localhost/<your-folder-name>/upload_image.php`
- Replace `<your-folder-name>` with the actual name you chose earlier.
- For example: `http://localhost/upload_project/upload_image.php`

---

## Notes

- `get_image_info.py` is a Python script and is executed by `upload_image.php`.
  - This means Python must be installed on your system.
- To check if Python is installed, open Command Prompt and type: `python --version`
  - If it returns something like `Python 3.13.5`, Python is correctly installed.
  - If it returns `'python' is not recognized as an internal or external command`, Python is not installed.
- To install Python, visit: https://www.python.org/ and follow the default installation instructions for your operating system.
