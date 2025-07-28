# Years Count Plugin

A simple plugin that displays the number of years since a specified date.

## Features

- Calculate years elapsed from any given date
- Lightweight and easy to use
- Customizable date input

## Installation

```bash
npm install years-count-plugin
```

## Usage

```javascript
import { yearsCount } from 'years-count-plugin';

const startDate = new Date('2020-01-01');
const years = yearsCount(startDate);
console.log(`Years elapsed: ${years}`);
```

## Development

### Prerequisites

- Node.js (version 14 or higher)
- npm

### Setup

1. Clone the repository:
```bash
git clone https://github.com/chadfuse/years-count-plugin.git
cd years-count-plugin
```

2. Install dependencies:
```bash
npm install
```

3. Build the project:
```bash
npm run build
```

### Scripts

- `npm run build` - Build the project
- `npm run test` - Run tests
- `npm run dev` - Start development mode

## License

MIT

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
