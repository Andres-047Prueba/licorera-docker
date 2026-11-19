// Pipeline como código - Licorera JP
// Flujo: commit -> GitHub -> Jenkins (Poll SCM) -> Build de imágenes -> Pruebas -> limpieza
pipeline {
    agent any

    options {
        timestamps()
        timeout(time: 20, unit: 'MINUTES')
        disableConcurrentBuilds()
        buildDiscarder(logRotator(numToKeepStr: '20'))
    }

    // Jenkins consulta GitHub cada ~2 minutos y construye solo si hay commits nuevos
    triggers {
        pollSCM('H/2 * * * *')
    }

    environment {

        COMPOSE = 'docker compose -p licorera_ci -f docker-compose.yml -f docker-compose.ci.yml'
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
                sh 'git log -1 --pretty=format:"Commit: %h | Autor: %an | Mensaje: %s"'
            }
        }

        stage('Build') {
            steps {
                withCredentials([file(credentialsId: 'licorera-env', variable: 'ENV_FILE')]) {
                    sh 'cp "$ENV_FILE" .env'
                }
                sh 'docker version --format "Docker cliente {{.Client.Version}} / servidor {{.Server.Version}}"'
                sh '$COMPOSE config --quiet'
                sh '$COMPOSE build'
                sh 'docker images --filter "reference=licorera*"'
            }
        }

        stage('Test') {
            steps {
                sh '$COMPOSE up -d --wait --wait-timeout 180'
                sh '$COMPOSE ps'
                sh 'bash tests/test_comunicacion.sh'
            }
        }
    }

    post {
        always {
            sh '$COMPOSE logs --no-color > compose.log 2>&1 || true'
            archiveArtifacts artifacts: 'compose.log', allowEmptyArchive: true
            sh '$COMPOSE down -v --remove-orphans || true'
            sh 'rm -f .env'
        }
        success {
            echo 'Build EXITOSO: las imágenes se construyeron y web y db se comunican por el nombre del servicio.'
        }
        failure {
            echo 'Build FALLIDO: revisa la etapa en rojo y el archivo compose.log.'
        }
    }
}
