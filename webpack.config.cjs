const path = require('path');

module.exports = {
  entry: './client/javascript/src/index.js',
  output: {
    path: path.resolve(__dirname, 'client/javascript'),
    filename: 'bundle.js',
    library: 'ApiClient',
    libraryTarget: 'umd',
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
          },
        },
      },
    ],
  },
};

