pipeline {
  agent any

  stages {
    stage('install') {
      steps {
        sh 'composer install --optimize-autoloader'
      }
    }
    stage('test') {
      parallel {

          stage('phpunit') {
            steps {
              sh 'php vendor/bin/phpunit  --log-junit var/test/phpunit-log.junit.xml'
            }
          }

          stage('checkstyle') {
            steps {
              sh 'php vendor/bin/phpcs  --report=checkstyle --report-file=var/test/checkstyle.xml || echo "oups exit code $?"'
            }
          }

          stage('php mess detector') {
            steps {
              sh 'php vendor/bin/phpmd src/ xml codesize,unusedcode,naming,cleancode,controversial,design  --reportfile var/test/phpmd.xml || echo "oups exit code $?"'
            }
          }

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
