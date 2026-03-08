const path = require( 'path' );

const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

// Import the helper to find and generate the entry points in the src directory
const { getWebpackEntryPoints } = require( '@wordpress/scripts/utils/config' );

// CSS minimizer
const CssMinimizerPlugin = require( 'css-minimizer-webpack-plugin' );

// Add any a new entry point by extending the webpack config.
module.exports = {
	...defaultConfig,
	mode: 'development',
	devtool: 'inline-source-map',
	entry: {
		...getWebpackEntryPoints(),
		dashboard: './src/index.js',
	},
	output: {
		path: path.resolve( __dirname, 'build' ),
	},
	optimization: {
		minimizer: [
			...defaultConfig.optimization.minimizer,
			new CssMinimizerPlugin(),
		],
	},
};
