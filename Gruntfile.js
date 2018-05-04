module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		sass: {
			dist: {
				files: {
					'webroot/css/admin/admin.min.css' : 'webroot/css/admin/sass/theme.scss',
					'webroot/css/front/front.min.css' : 'webroot/css/front/sass/theme.scss'
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
				src: [
					'webroot/css/admin/admin.min.css',
					'webroot/css/front/front.min.css'
				]
			}
		},
		watch: {
			css: {
				files: '**/*.scss',
				tasks: ['sass', 'postcss']
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-postcss');

	grunt.registerTask('default',['watch']);
	grunt.registerTask('all', ['sass','postcss']);

}
