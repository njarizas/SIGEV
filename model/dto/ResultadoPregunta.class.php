<?php
	/**
	 * Object represents table 'resultadospreguntas'
	 *
     	 * @author: http://phpdao.com
     	 * @date: 2016-07-24 18:58	 
	 */
	class ResultadoPregunta{
		
		private $idResultadosPreguntas;
		private $idResultadosExamenes;
		private $idRespuesta;
		private $idPregunta;
                
                function __construct($idResultadosExamenes, $idRespuesta, $idPregunta) {
                    $this->idResultadosExamenes = $idResultadosExamenes;
                    $this->idRespuesta = $idRespuesta;
                    $this->idPregunta = $idPregunta;
                }

                function getIdResultadosPreguntas() {
                    return $this->idResultadosPreguntas;
                }

                function getIdResultadosExamenes() {
                    return $this->idResultadosExamenes;
                }

                function getIdRespuesta() {
                    return $this->idRespuesta;
                }

                function getIdPregunta() {
                    return $this->idPregunta;
                }

                function setIdResultadosPreguntas($idResultadosPreguntas) {
                    $this->idResultadosPreguntas = $idResultadosPreguntas;
                }

                function setIdResultadosExamenes($idResultadosExamenes) {
                    $this->idResultadosExamenes = $idResultadosExamenes;
                }

                function setIdRespuesta($idRespuesta) {
                    $this->idRespuesta = $idRespuesta;
                }

                function setIdPregunta($idPregunta) {
                    $this->idPregunta = $idPregunta;
                }

		
	}
?>