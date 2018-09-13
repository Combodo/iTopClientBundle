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
        [
            $class: 'CloverPublisher',
            cloverReportDir: 'var/test/phpunit-log.report',
            cloverReportFileName: 'var/test/phpunit-log.coverage.xml',
            healthyTarget: [methodCoverage: 70, conditionalCoverage: 80, statementCoverage: 80], // optional, default is: method=70, conditional=80, statement=80
            unhealthyTarget: [methodCoverage: 50, conditionalCoverage: 50, statementCoverage: 50], // optional, default is none
            failingTarget: [methodCoverage: 0, conditionalCoverage: 0, statementCoverage: 0]     // optional, default is none
        ]
      }
      failure {
        slackSend(channel: "#jenkins-itop-hub", color: '#FF0000', message: "Ho no! Build failed! (${currentBuild.result}), Job '${env.JOB_NAME} [${env.BUILD_NUMBER}]' (${env.BUILD_URL})")
      }

    }

}