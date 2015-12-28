module.exports = function(grunt) {
  grunt.loadNpmTasks('grunt-bowercopy');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-uglify');

  grunt.initConfig({
    bowercopy: {
      scripts: {
        options: {
          destPrefix: 'build/temp'
        },
        files: {
          'js.cookie.js': 'js-cookie/src/js.cookie.js',
          'normalize.css': 'normalize-css/normalize.css',
          'reset.css': 'HTML5-Reset/assets/css/reset.css'
        }
      }
    },
    clean: {
      folder: [
        'bower_components',
        'build'
      ]
    },
    cssmin: {
      target: {
        files: {
          'public/css/build/404.css': 'public/css/404.css',
          'public/css/build/503.css': 'public/css/503.css',
          'public/css/build/blog.css': [
            'public/css/blog.css',
            'public/css/markup.css'
          ],
          'public/css/build/home.css': 'public/css/home.css',
          'public/css/build/lifestream.css': 'public/css/lifestream.css',
          'public/css/build/normalize.css': 'build/temp/normalize.css',
          'public/css/build/reset.css': 'build/temp/reset.css',
          'public/css/build/site.css': 'public/css/site.css'
        }
      }
    },
    uglify: {
      scripts: {
        files: {
          'public/js/build/js.cookie.min.js': 'build/temp/js.cookie.js'
        }
      }
    }
  });

  grunt.registerTask(
    'default',
    [
      'bowercopy',
      'uglify',
      'cssmin',
      'clean'
    ]
  );
};
