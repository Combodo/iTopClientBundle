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
        publishHTML([allowMissing: false, alwaysLinkToLastBuild: false, keepAll: false, reportDir: 'var/test/phpunit-log.report', reportFiles: 'index.html', reportName: 'code coverage', reportTitles: ''])
        step([
            $class: 'CloverPublisher',
            cloverReportDir: 'var/test/phpunit-log.report',
            cloverReportFileName: 'var/test/phpunit-log.coverage.xml',
            healthyTarget: [methodCoverage: 70, conditionalCoverage: 80, statementCoverage: 80], // optional, default is: method=70, conditional=80, statement=80
            unhealthyTarget: [methodCoverage: 50, conditionalCoverage: 50, statementCoverage: 50], // optional, default is none
            failingTarget: [methodCoverage: 0, conditionalCoverage: 0, statementCoverage: 0]     // optional, default is none
        ])
        checkstyle  pattern: 'var/test/checkstyle.xml', canComputeNew: false, defaultEncoding: '', healthy: '75', unHealthy: '10'
        pmd         pattern: 'var/test/phpmd.xml'     , canComputeNew: false, defaultEncoding: '', healthy: '', unHealthy: ''

      }
      failure {
        slackSend(channel: "#jenkins-itop-hub", color: '#FF0000', message: "Ho no! Build failed! (${currentBuild.result}), Job '${env.JOB_NAME} [${env.BUILD_NUMBER}]' (${env.BUILD_URL})")
      }

    }

}
