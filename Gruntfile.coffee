# Generated on 2014-10-15 using
# generator-webapp 0.5.1
"use strict"

# # Globbing
# for performance reasons we're only matching one level down:
# 'test/spec/{,*/}*.js'
# If you want to recursively match all subfolders, use:
# 'test/spec/**/*.js'
module.exports = (grunt) ->
  
  # Time how long tasks take. Can help when optimizing build times
  require("time-grunt") grunt
  
  # Load grunt tasks automatically
  require("load-grunt-tasks") grunt
  
  # Configurable paths
  config =
    app: "app"
    dist: "dist"

  # Define the configuration for all the tasks
  grunt.initConfig

    # Project settings
    config: config

    # Watches files for changes and runs tasks based on the changed files
    watch:
      bower:
        files: ["bower.json"]
        tasks: ["wiredep"]

      gruntfile:
        files: ["Gruntfile.js"]

      styles:
        files: ["<%= config.app %>/styles/{,*/}*.css"]
        tasks: [
          "newer:copy:styles"
          "autoprefixer"
        ]

      livereload:
        options:
          livereload: "<%= connect.options.livereload %>"

        files: [
          "<%= config.app %>/{,*/}*.html"
          "<%= config.app %>/{,*/}*.php"
          ".tmp/styles/{,*/}*.css"
          "<%= config.app %>/images/{,*/}*"
        ]

    # The actual grunt server settings
    connect:
      options:
        port: 9000
        open: true
        livereload: 35729
        
        # Change this to '0.0.0.0' to access the server from outside
        hostname: "localhost"

      livereload:
        options:
          middleware: (connect) ->
            [
              connect.static(".tmp")
              connect().use("/bower_components", connect.static("./bower_components"))
              connect.static(config.app)
            ]

      dist:
        options:
          base: "<%= config.dist %>"
          livereload: false


    # Empties folders to start fresh
    clean:
      dist:
        files: [
          dot: true
          src: [
            ".tmp"
            "<%= config.dist %>/*"
            "!<%= config.dist %>/.git*"
          ]
        ]

      server: ".tmp"

    # Add vendor prefixed styles
    autoprefixer:
      options:
        browsers: [
          "> 1%"
          "last 2 versions"
          "Firefox ESR"
          "Opera 12.1"
        ]

      dist:
        files: [
          expand: true
          cwd: ".tmp/styles/"
          src: "{,*/}*.css"
          dest: ".tmp/styles/"
        ]


    # Automatically inject Bower components into the HTML file
    wiredep:
      app:
        ignorePath: /^\/|\.\.\//
        src: ["<%= config.app %>/index.html", "<%= config.dist %>/{,*/}*.php"]


    # Renames files for browser caching purposes
    rev:
      dist:
        files:
          src: [
            "<%= config.dist %>/scripts/{,*/}*.js"
            "<%= config.dist %>/styles/{,*/}*.css"
            "<%= config.dist %>/images/{,*/}*.*"
            "<%= config.dist %>/styles/fonts/{,*/}*.*"
            "<%= config.dist %>/*.{ico,png}"
          ]


    # Reads HTML for usemin blocks to enable smart builds that automatically
    # concat, minify and revision files. Creates configurations in memory so
    # additional tasks can operate on them
    useminPrepare:
      options:
        dest: "<%= config.dist %>"
      html: "<%= config.app %>/index.html"

    # Performs rewrites based on rev and the useminPrepare configuration
    usemin:
      options:
        assetsDirs: [
          "<%= config.dist %>"
          "<%= config.dist %>/images"
          "<%= config.dist %>/styles"
        ]
      html: ["<%= config.dist %>/{,*/}*.html"]
      css: ["<%= config.dist %>/styles/{,*/}*.css"]

    # Copies remaining files to places other tasks can use
    copy:
      dist:
        files: [
          {
            expand: true
            cwd: "<%= config.app %>"
            dest: "<%= config.dist %>"
            src: [
              "*.{ico,png,txt}"
              "images/{,*/}*.*"
              "{,*/}*.html"
              "{,*/}*.php"
              "styles/fonts/{,*/}*.*"
              "cgi-bin/**"
              "hw*/**"
            ]
          }
          {
            src: "node_modules/apache-server-configs/dist/.htaccess"
            dest: "<%= config.dist %>/.htaccess"
          }
        ]

      styles:
        expand: true
        dot: true
        cwd: "<%= config.app %>/styles"
        dest: ".tmp/styles/"
        src: "{,*/}*.css"


    # Run some tasks in parallel to speed up build process
    concurrent:
      server: ["copy:styles"]
      dist: ["copy:styles"]

  grunt.registerTask "serve", "start the server and preview your app, --allow-remote for remote access", (target) ->
    grunt.config.set "connect.options.hostname", "0.0.0.0"  if grunt.option("allow-remote")
    if target is "dist"
      return grunt.task.run([
        "build"
        "connect:dist:keepalive"
      ])
    grunt.task.run [
      "clean:server"
      "wiredep"
      "concurrent:server"
      "autoprefixer"
      "connect:livereload"
      "watch"
    ]

  grunt.registerTask "server", (target) ->
    grunt.log.warn "The `server` task has been deprecated. Use `grunt serve` to start a server."
    grunt.task.run [(if target then ("serve:" + target) else "serve")]

  grunt.registerTask "chmod", (target) ->
    require("child_process").exec "chmod -R +x dist/cgi-bin"

  grunt.registerTask "build", [
    "clean:dist"
    "wiredep"
    "useminPrepare"
    "concurrent:dist"
    "autoprefixer"
    "concat"
    "cssmin"
    "uglify"
    "copy:dist"
    "rev"
    "usemin"
    "chmod"
  ]

  grunt.registerTask "sync", ->
    require("child_process").exec "scp -pr dist/* wst:www"

  grunt.registerTask "default", [
    "build"
    "sync"
  ]
