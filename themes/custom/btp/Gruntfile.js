module.exports = function(grunt) {

  require('load-grunt-tasks')(grunt);

  var themeJs = [
        'bower_components/matchHeight/jquery.matchHeight.js',
        'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/collapse.js',
        'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/dropdown.js',
        'js/btp.js'
      ];

  grunt.initConfig({

    concat: {
      themeJs: {
        files: {
          'js/dist/btp.js': themeJs
        }
      }
    },
    uglify: {
      options: {
        sourceMap: false
      },
      themeJs: {
        files: {
          'js/dist/btp.js': 'js/dist/btp.js'
        }
      }
    },
    cssmin: {
      target: {
        files: {
          'css/main.css': 'css/main.css'
        }
      }
    },
    watch: {
      gruntfile: {
        files: 'Gruntfile.js',
        options: {
          reload: true
        }
      },
      sass: {
        files: 'scss/**/*.scss',
        tasks: ['sass:dev', 'kss'],
        options: {
          livereload: true
        }
      },
      themeJs: {
        files: themeJs,
        tasks: ['concat:themeJs']
      }
    },
    sass: {
      options: {
        sourcemap: true,
        trace: true,
        includePaths: [
          'bower_components',
          'bower_components/bootstrap-sass-official/assets/stylesheets/',
          'bower_components/fontawesome/scss/'
        ]
      },
      dev: {
        options: {
          lineNumbers: true,
          outputStyle: 'nested'
        },
        files: {
          'css/main.css': 'scss/main.scss',
        }
      },
      dist: {
        options: {
          compressed: true
        },
        files: {
          'css/main.css': 'scss/main.scss'
        }
      }
    },
    jshint: {
      themeJs: {
        files: {
          src: ['js/btp.js']
        },
        options: {
          reporter: require('jshint-stylish'),
          jshintrc: '.jshintrc'
        }
      }
    },
    copy: {
      ksscss: {
        src: ['css/main.css', 'css/styleguide.css', 'css/admin.css'],
        dest: 'styleguide/public/'
      },
      kssscripts: {
        src: 'js/dist/**',
        dest: 'styleguide/assets/'
      },
      kssfonts: {
        src: 'fonts/**',
        dest: 'styleguide/assets/'
      }
    },
    kss: {
      options: {
        mask: '*.scss',
        template: './kss-template'
      },
      dist: {
        files: {
          './styleguide': ['./scss']
        }
      }
    }

  });

  grunt.registerTask("productionbuild", ['newer:concat', 'uglify', 'sass:dist', 'cssmin', 'guide']);
  grunt.registerTask("devbuild", ['newer:concat', 'sass:dev', 'guide']);
  grunt.registerTask("develop", ['devbuild','watch']);
  grunt.registerTask("default", ['develop']);
  return grunt.registerTask('guide', ['kss', 'copy:ksscss', 'copy:kssfonts', 'copy:kssscripts']);

};
