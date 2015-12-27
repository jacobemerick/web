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
          'normalize.css': 'normalize-css/normalize.css'
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
          'public/css/build/normalize.css': 'build/temp/normalize.css'
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
