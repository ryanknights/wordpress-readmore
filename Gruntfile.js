module.exports = function (grunt)
{
	grunt.initConfig({

		pkg : grunt.file.readJSON('package.json'),

		uglify :
		{
			app :
			{
				files :
				{
					'inc/assets/js/tms-readmore.min.js' : ['inc/assets/js/tms-readmore.js']
				}
			}
		},

		less :
		{
			app :
			{
				files :
				{
					'inc/assets/css/tms-readmore.css' : 'inc/assets/css/tms-readmore.less'
				}
			}
		},

		cssmin : 
		{	
			app :
			{
				files : 
				{
					'inc/assets/css/tms-readmore.css' : ['inc/assets/css/tms-readmore.css']
				}
			}
		},

		watch :
		{
			options :
			{
				livereload : true,
			},

			scripts :
			{
				files : ['inc/assets/js/tms-readmore.js'],
				tasks : ['uglify:app']
			},

			stylesheets :
			{
				files : ['inc/assets/css/tms-readmore.less'],
				tasks : ['less', 'cssmin']
			},
		}
	});

	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-uglify');

	grunt.registerTask('default', ['less', 'cssmin', 'uglify']);
};