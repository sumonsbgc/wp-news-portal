# EIS Theme Options Plugin

A comprehensive WordPress plugin for managing theme options for Dainik Purbokone news portal.

## Features

### 📿 Prayer Times Management

- Configure and display Islamic prayer times (Namaz times)
- Support for all five daily prayers plus sunrise
- Easy-to-use time picker interface
- Frontend display via shortcode

### ⚽ Sports News

- Add unlimited sports news entries
- Dynamic form fields with add/remove functionality
- Organized by sport name and news content

### 📺 YouTube Integration

- YouTube API configuration
- Channel ID management
- Multiple playlist ID support
- Ready for video content integration

### 📰 E-Paper Management

- Upload and display e-paper images
- File upload with preview functionality
- Proper media library integration

### 👥 Publication Information

- Editor and publisher name management
- Online poll content configuration
- Easy content management

## Installation

1. Upload the plugin files to `/wp-content/plugins/eis-theme-options/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to 'Theme Options' in the admin menu to configure settings

## Usage

### Admin Interface

Navigate to **Theme Options** in your WordPress admin panel to access the configuration interface. The plugin features a modern, sectioned interface with:

- **Prayer Times Section**: Configure Islamic prayer times
- **General Information**: Set editor/publisher details
- **YouTube Configuration**: API and channel settings
- **E-Paper Section**: Upload e-paper images
- **Sports News**: Manage sports content

### Frontend Integration

#### Using Helper Functions

```php
// Get a single option
$editor_name = eis_get_option('editor_name');

// Get prayer times
$prayer_times = eis_get_prayer_times();

// Get sports news
$sports_news = eis_get_sports_news();

// Get YouTube configuration
$youtube_config = eis_get_youtube_config();
```

#### Using Shortcodes

**Prayer Times**

```
[eis_prayer_times]
[eis_prayer_times title="Prayer Schedule"]
```

**Sports News**

```
[eis_sports_news]
[eis_sports_news limit="3" title="Latest Sports"]
```

**E-Paper**

```
[eis_epaper]
[eis_epaper width="600px"]
```

**Publication Info**

```
[eis_publication_info]
[eis_publication_info type="editor"]
[eis_publication_info type="publisher"]
```

## Technical Features

### 🔒 Security

- Proper data sanitization and validation
- WordPress nonce verification
- User capability checks
- SQL injection prevention

### 🎨 Modern UI/UX

- Responsive design
- Professional admin interface
- Intuitive form controls
- Real-time form validation
- Loading states and animations

### 🚀 Performance

- Efficient database operations
- Options caching system
- Optimized asset loading
- Minimal frontend footprint

### ♿ Accessibility

- ARIA labels and attributes
- Keyboard navigation support
- Screen reader compatibility
- Semantic HTML structure

## Database Structure

The plugin creates a custom table `wp_eis_dp_options` with the following structure:

```sql
CREATE TABLE wp_eis_dp_options (
  option_id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  option_group VARCHAR(255) NOT NULL,
  option_key VARCHAR(255) NOT NULL,
  option_value LONGTEXT NULL,
  is_serialized TINYINT(1) DEFAULT 0,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY unique_option (option_group, option_key)
);
```

## File Structure

```
eis-theme-options/
├── eis-theme-options.php          # Main plugin file
├── composer.json                  # Composer configuration
├── includes/                      # PHP classes
│   ├── Admin.php                 # Admin functionality
│   ├── Assets.php                # Asset management
│   ├── Frontend.php              # Frontend functionality
│   ├── Installer.php             # Database setup
│   ├── OptionsHelper.php         # Helper functions
│   ├── Admin/                    # Admin-specific classes
│   │   ├── Menu.php             # Admin menu
│   │   ├── ThemeOptions.php     # Options handling
│   │   └── views/               # Admin templates
│   └── Frontend/                # Frontend classes
│       └── Shortcode.php        # Shortcode functionality
├── assets/                       # Static assets
│   ├── css/
│   │   └── options.css          # Admin styles
│   └── js/
│       └── options.js           # Admin JavaScript
└── vendor/                       # Composer dependencies
```

## Development

### Requirements

- PHP 7.4+
- WordPress 5.0+
- MySQL 5.6+

### Code Standards

- PSR-4 autoloading
- WordPress coding standards
- Object-oriented architecture
- Proper namespacing

## Changelog

### Version 1.0.0

- Initial release
- Prayer times management
- Sports news functionality
- YouTube integration
- E-paper upload
- Publication information
- Modern admin interface
- Security enhancements
- Performance optimizations

## Support

For support and questions, please contact the development team or create an issue in the project repository.

## License

This plugin is licensed under the GPL v2 or later.

---

**Author**: Mohammad Sumon  
**Version**: 1.0.0  
**WordPress Compatibility**: 5.0+  
**PHP Compatibility**: 7.4+
