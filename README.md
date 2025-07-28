# Years Count WordPress Plugin

A WordPress plugin that displays the number of years since a specified date.

## Features

- Calculate years elapsed from any given date
- Easy shortcode integration
- Customizable date input
- Lightweight and fast

## Installation

### Via WordPress Admin

1. Download the plugin zip file
2. Go to your WordPress admin dashboard
3. Navigate to Plugins > Add New > Upload Plugin
4. Choose the zip file and click "Install Now"
5. Activate the plugin

### Manual Installation

1. Upload the `years-count` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

## Usage

Use the shortcode in your posts, pages, or widgets:

```
[years_count date="2020-01-01"]
```

### Shortcode Parameters

- `date` - The start date in YYYY-MM-DD format (required)
- `format` - Display format options (optional)

### Examples

```
[years_count date="2020-01-01"]
[years_count date="1990-05-15" format="detailed"]
```

## Development

### Prerequisites

- WordPress development environment
- PHP 7.4 or higher
- Basic knowledge of WordPress plugin development

### Setup

1. Clone the repository:
```bash
git clone https://github.com/chadfuse/years-count-plugin.git
cd years-count-plugin
```

2. Copy to your WordPress plugins directory:
```bash
cp -r years-count-plugin /path/to/wordpress/wp-content/plugins/years-count
```

3. Activate the plugin in your WordPress admin

### File Structure

```
years-count/
├── years-count.php          # Main plugin file
├── includes/               # Plugin includes
├── assets/                # CSS/JS files
└── README.md              # This file
```

## License

MIT

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## Support

For support, please create an issue on GitHub or contact the plugin author.
