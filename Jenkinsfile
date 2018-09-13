pipeline {
  agent any
  stages {
    stage('install') {
      steps {
        sh 'composer install --optimize-autoloader'
      }
    }
    stage('test') {
      steps {
        sh 'php vendor/bin/phpunit  --log-junit var/test/phpunit-log.junit.xml '
      }
    }
    stage('archive tests') {
      steps {
        junit 'var/test/phpunit-log.junit.xml '
      }
    }
  }
}