module.exports = {
  webpack(config) {
    config.module.rules.push({
      test: /\.(svg|png|jpg)$/i,
      issuer: {
        test: /\.(js|ts)x?$/,
      },
      use: ['url-loader'],
    });

    return config;
  },
  webpackDevMiddleware: config => {
    config.watchOptions = {
      poll: 1000,
      aggregateTimeout: 300,
    }

    return config
  },
  env: {
    API_ENTRYPOINT: process.env.API_ENTRYPOINT
  }
};
