module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		sass: {
			dist: {
				files: {
					'webroot/css/admin/admin.min.css' : 'webroot/css/admin/sass/theme.scss'
				}
			}
		},
		postcss: {
			options: {
				map: false, // inline sourcemaps
				processors: [
					require('pixrem')(), // add fallbacks for rem units
					require('autoprefixer')({browsers: 'last 8 versions'}), // add vendor prefixes
					require('cssnano')() // minify the result
				]
			},
			dist: {
				src: 'webroot/css/admin/admin.min.css'
			}
		},
		// JS
		uglify: {
			dev: {
				options: {
					beautify: false,
					mangle: true
				},
				files: {
					'webroot/js/front/app.min.js': [
						'webroot/js/front/app/app.js'
					],
					'webroot/js/admin/app.min.js': [
						'webroot/js/admin/app/app.js'
					]
				}
			},
		},
		watch: {
			scripts: {
				files: [
					'webroot/js/front/app/*.js',
					'webroot/js/admin/app/*.js'
				],
				tasks: ['uglify:dev'],
				options: {
					nospawn: true
				}
			},
			css: {
				files: '**/*.scss',
				tasks: ['sass', 'postcss']
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-postcss');

	grunt.registerTask('default',['watch']);
	grunt.registerTask('vendor', ['cssmin:vendor', 'uglify:vendor']);
	grunt.registerTask('all', ['cssmin:vendor', 'uglify:vendor','uglify:dev','sass','postcss']);

}
