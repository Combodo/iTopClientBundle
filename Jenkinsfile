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
        sh 'php vendor/bin/phpunit  --log-junit var/test/phpunit-log.junit.xml'
      }
    }
  }

  post {
      always {
        junit 'var/test/phpunit-log.junit.xml'
      }
      failure {
        slackSend(channel: "#jenkins-itop-hub", color: '#FF0000', message: "Ho no! Build failed! (${currentBuild.result}), Job '${env.JOB_NAME} [${env.BUILD_NUMBER}]' (${env.BUILD_URL})")
      }
    }

}